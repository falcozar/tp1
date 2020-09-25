<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Pages;
use App\Repository\CategoriesRepository;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="home")
     */
    public function index(PagesRepository $repo, CategoriesRepository $categorie)
    {
        // $pages = $repo->findAll();
        $pages = $repo->findBy(['etats' => 1 ]);
        $cat = $categorie->findBy(['etats' => 1 ]);
        // $users = $em->getRepository('MyProject\Domain\User')->findBy(array('age' => 20));
        return $this->render('home/index.html.twig', [
            'title' => 'Mon blog',
            'pages'=>$pages,
            'categories'=>$cat
        ]);
    }
     
}
