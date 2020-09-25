<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Users;
/**
 * @Route("/categories")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="categories_index", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categories_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserInterface $user): Response
    {
     //$create_by = $user->getId();
        $category = new Categories();
     
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);
        //dump($request->getSession());

       // dump($user->getId());
        //die;
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $category->setUsers($user);
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('categories_index');
        }

        return $this->render('categories/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categories_show", methods={"GET"})
     */
    public function show(Categories $category): Response
    {
        return $this->render('categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categories_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categories $category): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_index');
        }

        return $this->render('categories/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categories_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categories $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categories_index');
    }

    /**
     * @Route("/categories/delete/{id}", name="categories_delete")
     */
    public function supprimer(Categories $cat)
    {
        if ($cat)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cat); //pour supprimer l'objet article
            $em->flush(); //commit transaction
            //j'affiche le message en cas de succès
            $this->get('session')->getFlashBag()->add('message', 'Suppression effectuée avec succès');
            //redirection vers la liste des articles
            return $this->redirectToRoute('categories_index');

        }
       throw new NotFoundHttpException();
       
    }

    //show pages in category
     /**
     * @Route("/{id}/pages", name="page_by_category")
     */
    public function pagesByCategories(CategoriesRepository $categorie, Categories $category): Response
    {
        $cat = $categorie->findBy(['etats' => 1 ]); //for right place
        
        return $this->render('home/page_by_categorie.html.twig', [
            'blogs'=>$category,
            'categories'=>$cat
        ]);
    }



}
