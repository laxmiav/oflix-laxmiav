<?php

namespace App\Controller;
use App\Form\ReviewType;
use App\Entity\Review;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FormController extends AbstractController
{
     /**
     * displays the review
     *
     * @return Response
     * 
     * @Route("/review/{id}", name="review", methods={"GET", "POST"})
     */
    public function review(int $id,Request $request,MovieRepository $movieRepository) :Response
    {
        // préparation des données
        $review = new Review();
        $form = $this->createForm(ReviewType::class);
        $movie = $movieRepository->findOneWithAllData($id);
//dd($form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // récupérer les données
            
            // valider les données

            // traiter le formulaire
            

            // ajouter un flash message (facultatif)
            $this->addFlash('success', 'Votre review a bien été envoyé');
            // rediriger
            return $this->redirectToRoute('movie_show');
        }

        return $this->render('form/review.html.twig',[
             'form' => $form->createView(),'movie' => $movie
        ]);
    }
}
