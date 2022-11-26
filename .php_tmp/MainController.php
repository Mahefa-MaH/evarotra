<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\FluxActualitesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    
    #[Route('/', name: 'main')]
    public function index(ArticlesRepository $articlesRepository, FluxActualitesRepository $flux, CategoriesRepository $cat): Response
    {
        return $this->render('main/index.html.twig', [
            'articles' => $articlesRepository->lastTree(),
            'flux' => $flux->lastTree(),
            'cat' => $cat->lastTree(),
        ]);
    }
}
