<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_')]
    public function index(SessionInterface $session,
        ArticlesRepository $productsRepository
    ): Response
    {
        $pannier = $session->get("pannier", []);

        $dataPanier = [];

        $total = 0;

        foreach ($pannier as $id => $quantite) {
            $products = $productsRepository->find($id);
            $dataPanier[] = [
                "articles" => $products,
                "quantite" => $quantite,

            ];
            $total += $products->getPrix() * $quantite;
        }
        return $this->render('cart/cart.html.twig',
        compact("dataPanier","total"));
    }

    /**
     * @Route("/add/{id}", name="add")
     */
    #[Route("/add/{id}", name: 'add')]

     public function add(Articles $products, SessionInterface $session){
        $pannier = $session->get("pannier", []);
        $id = $products->getId();

        if(!empty($pannier[$id])){
            $pannier[$id]++;
        }else{  
            $pannier[$id] = 1;
        }

        $session->set("pannier", $pannier);
        dd($pannier);

        return $this->redirectToRoute("cart_index");
     }

     /**
     * @Route("/remove/{id}", name="remove")
     */
    #[Route("/remove/{id}", name: 'remove')]

    public function remove(Articles $products, SessionInterface $session){
        $pannier = $session->get("pannier", []);
        $id = $products->getId();

        if(!empty($pannier[$id])){
            if ($pannier[$id] > 1) {
                $pannier[$id]--;
            }
            else {
                unset($pannier[$id]);
            }
        }

        $session->set("pannier", $pannier);

        return $this->redirectToRoute("cart_");
     }

     /**
     * @Route("/delete/{id}", name="delete")
     */
    #[Route("/delete/{id}", name: 'delete')]

    public function delete(Articles $products, SessionInterface $session){
        $pannier = $session->get("pannier", []);
        $id = $products->getId();

        if(!empty($pannier[$id])){
            unset($pannier[$id]);
        }

        $session->set("pannier", $pannier);

        return $this->redirectToRoute("cart_");

     }

     /**
     * @Route("/delete", name="delete_all")
     */
    #[Route('/delete', name: 'delete_all')]

    public function deleteAll( SessionInterface $session){

        $session->remove("pannier");

        return $this->redirectToRoute("cart_");
     }
}
 