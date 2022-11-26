<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\Articles;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(
        CategoriesRepository $categoriesRepository 
        ): Response
    {
        return $this->render('categorie/categorie.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }
}
