<?php
namespace App\Controller;
use App\Model\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController{


 /**
     * displays the détail du film
     *
     * @return Response
     * 
     * @Route("/movie/{id}", name="moviedetails", requirements={"id"="\d+"} ,  methods={"GET"})
     */
    public function show(int $id = 0) :Response

    {
        // $movie = new Data;
        
        // $flim = $movie->getshows();
        // if ( ! array_key_exists($id,  $flim))
        // {
        //     // on jette une exception lorsque l'on rencontre une erreur
        //     // mais que l'on ne veut pas la gérer
        //     throw $this->createNotFoundException('The show does not exist');

        // }
         // préparation des données
        // require_once __DIR__ . '/../../sources/data.php';

        $flim = Data::getShow($id);

        // on vérifie si l'identifiant existe dans le tableau
        if ( is_null($flim))
        {
            // on jette une exception lorsque l'on rencontre une erreur
            // mais que l'on ne veut pas la gérer
            throw $this->createNotFoundException('The show does not exist');
        }




        return $this->render('movie/moviedetails.html.twig',['flim' => $flim]);
    }
 /**
     * displays the favoris 
     *
     * @return Response
     * 
     * @Route("/favorites", name="favorites")
     */
    public function favorites() :Response

    {
        
        return $this->render('movie/favorites.html.twig');
    }

/**
     * displays the list 
     *
     * @return Response
     * 
     * @Route("/list", name="list")
     */
    public function showList() :Response
    {
        return $this->render('movie/list.html.twig');
    }
  

    




}