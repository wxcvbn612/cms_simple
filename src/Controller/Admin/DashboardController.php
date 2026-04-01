<?php

namespace App\Controller\Admin;

use App\Repository\ActualiteRepository;
use App\Repository\ContactMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin')]
class DashboardController extends AbstractController
{
    #[Route('', name: 'admin_dashboard')]
    public function index(
        ActualiteRepository $actualiteRepo,
        ContactMessageRepository $messageRepo
    ): Response {
        return $this->render('admin/dashboard.html.twig', [
            'totalActualites' => count($actualiteRepo->findAll()),
            'unreadMessages'  => $messageRepo->countUnread(),
        ]);
    }
}
