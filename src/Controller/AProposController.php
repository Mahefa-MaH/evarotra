<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AProposController extends AbstractController
{
    #[Route('/a-propos', name: 'app_a_propos')]
    public function index(
        UsersRepository $UsersRepository
    ): Response
    {
        return $this->render('a_propos/apropos.html.twig', [
            'vendeur' => $UsersRepository->getVendeur(),
        ]);
    }
}
