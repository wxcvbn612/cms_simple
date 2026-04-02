<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/actualites')]
class ActualiteController extends AbstractController
{
    #[Route('', name: 'admin_actualite_index')]
    public function index(ActualiteRepository $repo): Response
    {
        return $this->render('admin/actualite/index.html.twig', [
            'actualites' => $repo->findAllOrderedByDate(),
        ]);
    }

    #[Route('/new', name: 'admin_actualite_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        $actualite = new Actualite();
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleImageUpload($form, $actualite, $slugger);

            $em->persist($actualite);
            $em->flush();

            $this->addFlash('success', 'admin.actualite.created');
            return $this->redirectToRoute('admin_actualite_index');
        }

        return $this->render('admin/actualite/new.html.twig', ['form' => $form]);
    }

    #[Route('/{id}/edit', name: 'admin_actualite_edit', methods: ['GET', 'POST'])]
    public function edit(
        Actualite $actualite,
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response {
        $form = $this->createForm(ActualiteType::class, $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleImageUpload($form, $actualite, $slugger);

            $em->flush();

            $this->addFlash('success', 'admin.actualite.updated');
            return $this->redirectToRoute('admin_actualite_index');
        }

        return $this->render('admin/actualite/edit.html.twig', [
            'actualite' => $actualite,
            'form'      => $form,
        ]);
    }

    #[Route('/{id}/toggle', name: 'admin_actualite_toggle', methods: ['POST'])]
    public function toggle(Actualite $actualite, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('toggle' . $actualite->getId(), $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $actualite->setIsPublished(!$actualite->isPublished());
        $em->flush();

        $this->addFlash('success', 'admin.actualite.toggled');
        return $this->redirectToRoute('admin_actualite_index');
    }

    #[Route('/{id}/delete', name: 'admin_actualite_delete', methods: ['POST'])]
    public function delete(
        Actualite $actualite,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $actualite->getId(), $request->request->get('_token'))) {
            // Remove image file if exists
            if ($actualite->getImage()) {
                $imagePath = $this->getParameter('kernel.project_dir') . '/public/uploads/actualites/' . $actualite->getImage();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $em->remove($actualite);
            $em->flush();

            $this->addFlash('success', 'admin.actualite.deleted');
        }

        return $this->redirectToRoute('admin_actualite_index');
    }

    private function handleImageUpload($form, Actualite $actualite, SluggerInterface $slugger): void
    {
        $imageFile = $form->get('imageFile')->getData();
        if (!$imageFile) {
            return;
        }

        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/actualites';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

        try {
            $imageFile->move($uploadDir, $newFilename);
            // Delete old image
            if ($actualite->getImage()) {
                $old = $uploadDir . '/' . $actualite->getImage();
                if (file_exists($old)) {
                    unlink($old);
                }
            }
            $actualite->setImage($newFilename);
        } catch (FileException) {
            $this->addFlash('error', 'admin.upload.error');
        }
    }
}
