<?php

namespace App\Controller;


use App\Entity\Articles;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //insertion manuelle
        /*
        for ($i=1; $i<20; $i++)
        {
            $article = new Articles();
            $article->setNom('UC');   
            $article->setDescription('Ordinateur de bureau N° : '. $i);   
            $article->setQuantite(1);   
            $article->setPrix(400000); 
            $em->persist($article);
            $em->flush();
        }*/
        

       
        //page normale form search no post
        if ($request->getMethod() === "GET")
        {
            //Pas de filtre
            $articles = $em->getRepository(Articles::class)->findAll();
        }
        //si on post le formulaire 
        if ($request->getMethod("POST"))
        {
            //on fait la recherche ie on utilise la requete personnalisé
            $recherche = $request->get('txtRecherche');
            $articles = $em->getRepository(Articles::class)->searchByName($recherche);

        }
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }

     /**
     * @Route("/articles/edit/{id}", name="edit_article")
     */
    public function editer(Request $request)
    {
        
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
                
        $article = $em->getRepository(Articles::class)->find($id);
       

        return $this->render('articles/editer.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/articles/create", name="new_article")
     * @Route("/articles/update/{id}", name="update_article")
     */
    public function modifier(Request $request)
    {
        
        $type=0;
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $article = new Articles();
        $succes_message = 'Création effectuée avec succès';
        if ($id !== null)
        {
            $article = $em->getRepository(Articles::class)->find($id);
            $type = 1; //edition
            $succes_message = 'Mise à jour effectuée avec succès';
        }
        //creation form dans le controlleur
        $form = $this->createForm(ArticleType::class, $article);
       $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //insertion dans la table articles
            $em->persist($article);
            $em->flush();
            //affichage message en cas de succès
            $this->get('session')->getFlashBag()->add('message', $succes_message);
            //on fait une redirection vers la liste des articles
            return $this->redirectToRoute('articles');
        }
         return $this->render('articles/form.html.twig', [
            'article' => $article,
            'formulaire'=>$form->createView(),
            'type_form'=>$type

        ]);
    }

    /**
     * @Route("/articles/print/{id}", name="print_article")
     */
    public function imprimer(Request $request)
    {
        
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
                
        $article = $em->getRepository(Articles::class)->find($id);


        return $this->render('articles/editer.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/articles/delete/{id}", name="delete_article")
     */
    public function supprimer(Articles $article)
    {
        if ($article)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article); //pour supprimer l'objet article
            $em->flush(); //commit transaction
            //j'affiche le message en cas de succès
            $this->get('session')->getFlashBag()->add('message', 'Suppression effectuée avec succès');
            //redirection vers la liste des articles
            return $this->redirectToRoute('articles');

        }
        throw new NotFoundHttpException('Suppression impossible');
        
        
    
    }

}
