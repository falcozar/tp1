<?php

namespace App\Controller;
use App\Entity\Pages;
use App\Form\PagesType;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Users;
class PagesController extends AbstractController
{
    /**
     * @Route("/blogs", name="list_page")
     */
    public function index(PagesRepository $repo)
    {
        $pages = $repo->findAll();
        return $this->render('pages/index.html.twig', [
            'title'=>'Listing blog',
            'pages'=>$pages,
        ]);
    }
    /**
     * @Route("/page/new", name="create_page")
     * @Route("/page/edit/{id}", name="update_page")
     */
    public function formPage(Request $request, UserInterface $user)
    {
        $type=0;
        $succes_message = 'Création effectuée avec succès';   
        $id = $request->get('id');
        $manager = $this->getDoctrine()->getManager();
        $page = new Pages();
        if ($id !== null)
        {
            $page = $manager->getRepository(Pages::class)->find($id);
            $type = 1; //edition
            $succes_message = 'Mise à jour effectuée avec succès';
        }
        //appelle du form PageType
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
              //$page->setCreatedAt(new \DateTime());
              //session à insérer pour l'user 
            $page->setUsers($user);  
            //insertion dans la table articles
            $manager->persist($page);
            $manager->flush();
            //affichage message en cas de succès
            $this->get('session')->getFlashBag()->add('message', $succes_message);
            //on fait une redirection vers la liste des articles
            return $this->redirectToRoute('list_page');
        }


        //dump($request);die;
        return $this->render('pages/frm_blog.html.twig', [
            'title'=>'Gestion des pages',
            'formpage'=>$form->createView(),
            'type_form'=>$type

        ]);
    }
    /**
     * @Route("/page/{id}", name="detail_page")
     */
    public function show(Pages $page)
    {
        return $this->render('home/index.html.twig', [
            'page'=>$page,
        ]);
    }
}




