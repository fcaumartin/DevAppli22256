<?php

namespace App\Controller;

use App\Entity\Disc;
use App\Repository\DiscRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TestController extends AbstractController
{
    #[Route('/', name: 'app_test')]
    public function index(DiscRepository $repo): Response
    {
        $discs = $repo->findAll();

        

        return $this->render('test/index.html.twig', [
            'discs' => $discs,
        ]);
    }

    #[Route('/add/{disc}', name: 'panier_add')]
    public function add(SessionInterface $session, Disc $disc, Request $request): Response
    {
        $panier = $session->get("panier", []);

        if (isset($panier[$disc->getId()])) {
            $panier[$disc->getId()]++;
        }
        else {
            $panier[$disc->getId()] = 1;
        }

        $session->set("panier", $panier);

        // $referer = (string) $request->headers->get('referer');

        // dd($referer);

        return $this->redirect("/");
    }

    #[Route('/panier', name: 'panier')]
    public function panier(SessionInterface $session, DiscRepository $repo): Response
    {
        $panier = $session->get("panier", []);
        // dd($panier);

        $nouveau_panier = [];
        foreach ($panier as $key => $value) {
            $p = $repo->find($key);
            $nouveau_panier[] = $p;
        }
        
        dump($panier);
        dump($nouveau_panier);
        return $this->render('test/panier.html.twig', [
            'panier' => $panier,
            'nouveau_panier' => $nouveau_panier
        ]);
    }
}
