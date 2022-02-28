<?php

namespace App\Controller;

use App\Model\ShowModel;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use App\Repository\CastingRepository;
use App\Entity\Person;
use App\Entity\Casting;
use App\Entity\movie;


class MovieController extends AbstractController
{

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
    // TODO ajouter une route removeFromFavorite qui retire des favoris et redirige vers la page des favoris










    /**
     * @Route("/favorites/add/{movieId}", name="movie_add_favorite", requirements={"movieId"="\d+"}, methods={"GET"})
     * 
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

    // TODO ajouter une route removeFromFavorite qui retire des favoris et redirige vers la page des favoris

    /**
     * @Route("/favorites", name="movie_favorite")
     */
    public function favorite(SessionInterface $session): Response
    {
        // récupérer les movies qui sont en session
        $favoriteMovieIds = $session->get('favorite_list', []);
        $favoriteMoviesComplete = [];

        foreach ($favoriteMovieIds as $movieId)
        {
            $favoriteMoviesComplete[$movieId] = ShowModel::getShow($movieId);
        }
        
        // var_dump($favoriteMoviesComplete); die();

        return $this->render('movie/favorite.html.twig', [
            'show_list' => $favoriteMoviesComplete,
        ]);
    }

    /**
     * @Route("/films/{id}", name="movie_show", requirements={"id"="\d+"}, methods={"GET"})
     * @Entity("person", expr="repository.find(person-id)")
     * @Entity("casting", expr="repository.find(casting-id)")
     */
    public function show(int $id,  MovieRepository $movierepositary,PersonRepository $personrepository): Response
    {
       $movie = $movierepositary->find($id);
       $castingid = $movie->getCastings();
       $personid = $personrepository->find($castingid);
       //$casting = $castingrepository->find(2);
       

        //$movie = ShowModel::getShow($movieId);

        // on vérifie si l'identifiant existe dans le tableau
        if ( is_null($movie))
        {
            // on jette une exception lorsque l'on rencontre une erreur
            // mais que l'on ne veut pas la gérer
            throw $this->createNotFoundException('The show does not exist');
        }

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
            'movie_id' => $id,
            'personid' => $personid,
            
        ]);
       // dd($person);

        // gestion avec une Exception
        // try {
        //     $movie = ShowModel::getShow($movieId);
        // }
        // catch (Exception $e)
        // {
        //     // on jette une exception lorsque l'on rencontre une erreur
        //     // mais que l'on ne veut pas la gérer
        //     throw $this->createNotFoundException('The show does not exist');
        // }
        // return $this->render('movie/show.html.twig', [
        //     'movie' => $movie,
        // ]);
    }

}
