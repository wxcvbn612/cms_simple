<?php

namespace App\Controller\Admin;

use App\Form\SiteSettingsType;
use App\Repository\SiteSettingsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/settings')]
class SettingsController extends AbstractController
{
    #[Route('', name: 'admin_settings_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        SiteSettingsRepository $repo,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        $settings = $repo->getSettings();
        $form = $this->createForm(SiteSettingsType::class, $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/logo';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            foreach (['logoFile' => 'logoFilename', 'faviconFile' => 'faviconFilename'] as $field => $setter) {
                $file = $form->get($field)->getData();
                if ($file) {
                    $safe = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $newFilename = $safe . '-' . uniqid() . '.' . $file->guessExtension();
                    try {
                        $file->move($uploadDir, $newFilename);
                        $settings->{'set' . ucfirst($setter)}($newFilename);
                    } catch (FileException) {
                        $this->addFlash('error', 'admin.upload.error');
                    }
                }
            }

            $em->flush();
            $this->addFlash('success', 'admin.settings.updated');
            return $this->redirectToRoute('admin_settings_edit');
        }

        return $this->render('admin/settings/edit.html.twig', ['form' => $form]);
    }
}
