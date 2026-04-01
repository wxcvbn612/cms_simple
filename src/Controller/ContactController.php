<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactType;
use App\Service\ContactMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/{_locale}/contact', name: 'contact', requirements: ['_locale' => 'fr|ar'])]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        ContactMailer $mailer
    ): Response {
        $message = new ContactMessage();
        $form = $this->createForm(ContactType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Honeypot check
            if ($form->get('website')->getData() !== null && $form->get('website')->getData() !== '') {
                return $this->redirectToRoute('home', ['_locale' => $request->getLocale()]);
            }

            $em->persist($message);
            $em->flush();

            try {
                $mailer->sendContactNotification($message);
            } catch (\Exception) {
                // Mailer failure should not block DB save
            }

            $this->addFlash('success', 'contact.success');
            return $this->redirectToRoute('contact', ['_locale' => $request->getLocale()]);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
