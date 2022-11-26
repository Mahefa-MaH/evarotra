<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\FluxActualitesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActualiteController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualite')]
    public function index(
        FluxActualitesRepository $fluxActualitesRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data =  $fluxActualitesRepository->findAll();

        $actualites = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('actualite/actualite.html.twig', [
            'actualites' => $actualites,
        ]);
    }
}
