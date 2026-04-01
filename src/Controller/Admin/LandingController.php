<?php

namespace App\Controller\Admin;

use App\Form\LandingPageContentType;
use App\Repository\LandingPageContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/landing')]
class LandingController extends AbstractController
{
    #[Route('', name: 'admin_landing_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        LandingPageContentRepository $repo,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        $content = $repo->getContent();
        $form = $this->createForm(LandingPageContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadFields = [
                'heroBackgroundImageFile' => ['dir' => 'hero',  'setter' => 'setHeroBackgroundImage'],
                'aboutImageFile'          => ['dir' => 'about', 'setter' => 'setAboutImage'],
            ];

            foreach ($uploadFields as $field => ['dir' => $dir, 'setter' => $setter]) {
                $file = $form->get($field)->getData();
                if ($file) {
                    $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/' . $dir;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    $safe = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $newFilename = $safe . '-' . uniqid() . '.' . $file->guessExtension();

                    try {
                        $file->move($uploadDir, $newFilename);
                        $content->$setter($newFilename);
                    } catch (FileException) {
                        $this->addFlash('error', 'admin.upload.error');
                    }
                }
            }

            $em->flush();
            $this->addFlash('success', 'admin.landing.updated');
            return $this->redirectToRoute('admin_landing_edit');
        }

        return $this->render('admin/landing/edit.html.twig', ['form' => $form]);
    }
}
