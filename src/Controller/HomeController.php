<?php

namespace App\Controller;

use App\Entity\Pages;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="home")
     */
    public function index(PagesRepository $repo)
    {
        $pages = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'title' => 'Mon blog',
            'pages'=>$pages,
        ]);
    }
     
}
