<?php

namespace App\Controller;

use App\Repository\ActualiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'root_redirect')]
    public function redirectToLocale(Request $request): RedirectResponse
    {
        $preferred = $request->getPreferredLanguage(['fr', 'ar']) ?? 'fr';
        return $this->redirectToRoute('home', ['_locale' => $preferred]);
    }

    #[Route('/{_locale}', name: 'home', requirements: ['_locale' => 'fr|ar'])]
    public function index(ActualiteRepository $actualiteRepo): Response
    {
        $actualites = $actualiteRepo->findPublished(6);

        return $this->render('home/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }
}
