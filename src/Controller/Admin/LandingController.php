<?php

namespace App\Controller\Admin;

use App\Form\LandingPageContentType;
use App\Repository\LandingPageContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
                'heroBackgroundImageFile' => ['dir' => 'hero',     'setter' => 'setHeroBackgroundImage'],
                'aboutImageFile'          => ['dir' => 'about',    'setter' => 'setAboutImage'],
                'serviceCard1ImageFile'   => ['dir' => 'services', 'setter' => 'setServiceCard1Image'],
                'serviceCard2ImageFile'   => ['dir' => 'services', 'setter' => 'setServiceCard2Image'],
                'serviceCard3ImageFile'   => ['dir' => 'services', 'setter' => 'setServiceCard3Image'],
                'galleryImage1File'       => ['dir' => 'gallery',  'setter' => 'setGalleryImage1'],
                'galleryImage2File'       => ['dir' => 'gallery',  'setter' => 'setGalleryImage2'],
                'galleryImage3File'       => ['dir' => 'gallery',  'setter' => 'setGalleryImage3'],
                'galleryImage4File'       => ['dir' => 'gallery',  'setter' => 'setGalleryImage4'],
                'galleryImage5File'       => ['dir' => 'gallery',  'setter' => 'setGalleryImage5'],
                'galleryImage6File'       => ['dir' => 'gallery',  'setter' => 'setGalleryImage6'],
                'partnerLogo1File'        => ['dir' => 'partners', 'setter' => 'setPartnerLogo1'],
                'partnerLogo2File'        => ['dir' => 'partners', 'setter' => 'setPartnerLogo2'],
                'partnerLogo3File'        => ['dir' => 'partners', 'setter' => 'setPartnerLogo3'],
                'partnerLogo4File'        => ['dir' => 'partners', 'setter' => 'setPartnerLogo4'],
                'partnerLogo5File'        => ['dir' => 'partners', 'setter' => 'setPartnerLogo5'],
                'partnerLogo6File'        => ['dir' => 'partners', 'setter' => 'setPartnerLogo6'],
            ];

            foreach ($uploadFields as $field => ['dir' => $dir, 'setter' => $setter]) {
                $file = $form->get($field)->getData();
                if ($file instanceof UploadedFile) {
                    $newFilename = $this->uploadImage($file, $dir, $slugger);

                    if ($newFilename !== null) {
                        $content->$setter($newFilename);
                    }
                }
            }

            $em->flush();
            $this->addFlash('success', 'admin.landing.updated');
            return $this->redirectToRoute('admin_landing_edit');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'admin.form.invalid');
        }

        return $this->render('admin/landing/edit.html.twig', ['form' => $form]);
    }

    private function uploadImage(UploadedFile $file, string $dir, SluggerInterface $slugger): ?string
    {
        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/' . $dir;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $safe = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->guessExtension() ?: strtolower((string) pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));
        $extension = $extension !== '' ? $extension : 'bin';
        $newFilename = sprintf('%s-%s.%s', $safe, uniqid('', true), $extension);

        try {
            $file->move($uploadDir, $newFilename);

            return $newFilename;
        } catch (FileException) {
            $this->addFlash('error', 'admin.upload.error');

            return null;
        }
    }
}
