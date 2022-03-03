<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Form\MovieeditType;

class MovieController extends AbstractController
{
    /**
     * @Route("/backoffice/movie", name="backoffice_movie_list")
     */
    public function list(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();


        return $this->render('backoffice/movie/list.html.twig', [
            'movies' => $movies
        ]);
    }


     /**
     * @Route("/backoffice/movie/{id}/read", name="backoffice_movie_read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(int $id, MovieRepository $movieRepository): Response
    {
       

        // $movie = ShowModel::getShow($movieId);
        $movie = $movieRepository->findOneWithAllData($id);

        

        // on vérifie si l'identifiant existe dans le tableau
        if ( is_null($movie))
        {
            
            throw $this->createNotFoundException('The show does not exist');
        }

        return $this->render('backoffice/movie/read.html.twig', [
            'movie' => $movie,
            'movie_id' => $movie->getId(),
        ]);

        
    }
    
     /**
     * @Route("/backoffice/movie/{id}/edit", name="backoffice_movie_edit", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit(int $id, MovieRepository $movieRepository,ManagerRegistry $doctrine,Request $request): Response
    {
       

      
        $movie = $movieRepository->findOneWithAllData($id);
        //$movie = new Movie();
       

        // préparation des données
       
        $form = $this->createForm(MovieeditType::class, $movie);
        
        //dd($form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // récupérer les données
           
            $updateDate = new \DateTime();
            $movie->setUpdatedAt($updateDate);
            // valider les données
       
             $entityManager = $doctrine->getManager();
             $entityManager->flush();
            
           // dd( $movie);
            // // ajouter un flash message (facultatif)
            $this->addFlash('success', 'Votre movie a bien été modifié');
            // // rediriger
             return $this->redirectToRoute('backoffice_movie_read',['id' => $movie->getId()]);
        }

        return $this->renderform('backoffice/movie/edit.html.twig', [
            'form' => $form,
            'movie' => $movie,
            
        ]);

        
    }

    /**
     * @Route("/backoffice/movie/{id}/delete", name="backoffice_movie_delete", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function delete(Movie $movie, ManagerRegistry $doctrine): Response
    {
        // Un objet ParamConverter s'occupe de 
        // récupérer l'article en fonction de l'id fournit
        // si article non trouvé alors il renvoit une 404

        // si le code continue c'est que l'article a été trouvé et qu'il est dans l'objet $article

        // dire à doctrine de supprimer l'article
        $entityManager = $doctrine->getManager();
        $entityManager->remove($movie);
        
        // dire à doctrine d'exécuter la requête de suppression
        $entityManager->flush();

        // redirection
        return $this->redirectToRoute('backoffice_movie_list');
    }
    

     /**
     * displays the review
     *
     * @return Response
     * 
     * @Route("/backoffice/movie/add", name="backoffice_movie_add", methods={"GET", "POST"})
     */
    public function add(Request $request,MovieRepository $movieRepository,ManagerRegistry $doctrine) :Response
    {
        // préparation des données
        $movie = new Movie();
        $form = $this->createForm(MovieeditType::class, $movie);
       
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $created = new \DateTime();
            $movie->setCreatedAt($created);
           
               
                $entityManager = $doctrine->getManager();  
               $entityManager->persist($movie);
           
               // dire à doctrine d'exécuter les requêtes
              $entityManager->flush();
            
   
           
             return $this->redirectToRoute('backoffice_movie_list');
        }

        return $this->render('backoffice/movie/add.html.twig',[
             'form' => $form->createView(),
        ]);
    }








}
