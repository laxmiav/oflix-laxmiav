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
use Doctrine\Persistence\ManagerRegistry;

class FormController extends AbstractController
{
     /**
     * displays the review
     *
     * @return Response
     * 
     * @Route("/review/{id}", name="review", methods={"GET", "POST"})
     */
    public function review(int $id,Request $request,MovieRepository $movieRepository,ManagerRegistry $doctrine) :Response
    {
        // préparation des données
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $movie = $movieRepository->findOneWithAllData($id);
//dd($form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // récupérer les données
            $review->setMovie($movie);
            // valider les données

            // traiter le formulaire
              // dire à doctrine de gérer l'objet review
              $entityManager = $doctrine->getManager();
              $entityManager->persist($review);
  
              // dire à doctrine d'exécuter les requêtes
              $entityManager->flush();
            
dd( $review);
            // // ajouter un flash message (facultatif)
            // $this->addFlash('success', 'Votre review a bien été envoyé');
            // // rediriger
             return $this->redirectToRoute('movie_show',['id' => $movie->getId()]);
        }

        return $this->render('form/review.html.twig',[
             'form' => $form->createView(),'movie' => $movie
        ]);
    }
}
