<?php

namespace App\Controller\Admin;

use App\Entity\ContactMessage;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/messages')]
class MessageController extends AbstractController
{
    #[Route('', name: 'admin_message_index')]
    public function index(ContactMessageRepository $repo): Response
    {
        return $this->render('admin/message/index.html.twig', [
            'messages' => $repo->findAllOrderedByDate(),
        ]);
    }

    #[Route('/{id}/read', name: 'admin_message_read', methods: ['POST'])]
    public function markRead(ContactMessage $message, EntityManagerInterface $em): Response
    {
        $message->setIsRead(true);
        $em->flush();

        return $this->redirectToRoute('admin_message_index');
    }

    #[Route('/{id}/delete', name: 'admin_message_delete', methods: ['POST'])]
    public function delete(
        ContactMessage $message,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $message->getId(), $request->request->get('_token'))) {
            $em->remove($message);
            $em->flush();
            $this->addFlash('success', 'admin.message.deleted');
        }

        return $this->redirectToRoute('admin_message_index');
    }
}
