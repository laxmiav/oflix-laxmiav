<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{

    /**
     * @Route("/favorites/add/{movieId}", name="movie_add_favorite", requirements={"movieId"="\d+"}, methods={"GET"})
     */
    public function addFavorite(int $movieId, SessionInterface $session): Response
    {
        // récupérer le tableau qui est actuellement en session
        $currentFavorites = $session->get('favorite_list', []);

        // ajouter la clef dans ce tableau
        $currentFavorites[$movieId] = $movieId;

        // ré-enregistrer le tableau complet en session
        $session->set('favorite_list', $currentFavorites);

        // préparer un flash message 
        $this->addFlash('success', 'Elément ajouté aux favoris avec succès');
        $this->addFlash('success', 'Bien joué !');

        // addFlash crée un tableau de tableau de messages
        // $this->addFlash('success', '2eme message');
        // $this->addFlash('error', 'message d erreur');

        // $messages['success'] = [
        //     'Element ajouté',
        //     '2eme message'
        // ];
        // $messages['error'] = [
        //     'message d erreur'
        // ];

        // rediriger l'utilisateur vers la page
        return $this->redirectToRoute('movie_favorite');

        // echo $movieId;die();
    }

    // TODO faire une route removeFromFavorite qui retire tous les favoris et redirige vers la page des favoris
    
    /**
     * @Route("/favorites/remove/{movieId}", name="movie_remove_favorite", requirements={"movieId"="\d+"}, methods={"GET"})
     */
    public function removeFavorite(int $movieId, SessionInterface $session): Response
    {
        // récupérer le tableau des favoris
        $currentFavorites = $session->get('favorite_list', []);

        // supprimer le film demandé du tableau
        unset($currentFavorites[$movieId]);

        // re-enregistrer le tableau des favoris dans la session
        $session->set('favorite_list', $currentFavorites);

        $this->addFlash('success', 'Film retiré des favoris avec succès');
        
        // rediriger vers la page des favoris
        return $this->redirectToRoute('movie_favorite');

    }

    /**
     * @Route("/favorites", name="movie_favorite")
     */
    public function favorite(SessionInterface $session, MovieRepository $movieRepository): Response
    {
        // récupérer les movies qui sont en session
        $favoriteMovieIds = $session->get('favorite_list', []);
        $favoriteMoviesComplete = "";

        foreach ($favoriteMovieIds as $movieId)
        {
            $favoriteMoviesComplete[$movieId] = $movieRepository->find($movieId);
        }
        
         //var_dump($favoriteMoviesComplete); die();

        return $this->render('movie/favorite.html.twig', [
            'show_list' => $favoriteMoviesComplete,
        ]);
    }

    /**
     * @Route("/films/{slug}", name="movie_show", methods={"GET"})
     * 
     */
    public function show( Movie $movie, MovieRepository $movieRepository,$mySlugger): Response
    {
        
       // $movie = $movieRepository->findOneWithAllData($slug);

        

        // on vérifie si l'identifiant existe dans le tableau
        if ( is_null($movie))
        {
            // on jette une exception lorsque l'on rencontre une erreur
            // mais que l'on ne veut pas la gérer
            throw $this->createNotFoundException('The show does not exist');
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
            'movie_id' => $movie->getId(),
        ]);

        
    }
      /**
     * @Route("/films", name="movie_list", methods={"GET"})
     */
    public function list(MovieRepository $movieRepository): Response
    {
        // préparation des données 

        // récupérer la liste des films
        //$allMovies = $movieRepository->findAll();
        //$allMovies = $movieRepository->findBy([], ['title' => 'ASC']);
        $allMovies = $movieRepository->findAllOrderByTitle();
        // fournir les données à la view
        return $this->render('movie/list.html.twig', [
            'movie_list' => $allMovies,
        ]);
    }

    

}
