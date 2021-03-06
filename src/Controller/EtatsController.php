<?php

namespace App\Controller;

use App\Entity\Etats;
use App\Form\EtatsType;
use App\Repository\EtatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etats")
 */
class EtatsController extends AbstractController
{
    /**
     * @Route("/", name="etats_index", methods={"GET"})
     */
    public function index(EtatsRepository $etatsRepository): Response
    {
        return $this->render('etats/index.html.twig', [
            'etats' => $etatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etat = new Etats();
        $form = $this->createForm(EtatsType::class, $etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etat);
            $entityManager->flush();

            return $this->redirectToRoute('etats_index');
        }

        return $this->render('etats/new.html.twig', [
            'etat' => $etat,
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/{id}/edit", name="etats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etats $etat): Response
    {
        $form = $this->createForm(EtatsType::class, $etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etats_index');
        }

        return $this->render('etats/edit.html.twig', [
            'etat' => $etat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etats_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Etats $etat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etats_index');
    }

 /**
     * @Route("/etats/delete/{id}", name="delete_etats")
     */
    public function supprimer(Etats $etat)
    {
        if ($etat)
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etat); //pour supprimer l'objet article
            $em->flush(); //commit transaction
            //j'affiche le message en cas de succès
            $this->get('session')->getFlashBag()->add('message', 'Suppression effectuée avec succès');
            //redirection vers la liste des articles
            return $this->redirectToRoute('etats_index');

        }
       throw new NotFoundHttpException();
       
    }

}
