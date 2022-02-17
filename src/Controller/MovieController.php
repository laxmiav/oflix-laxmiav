<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController{


 /**
     * displays the détail du film
     *
     * @return Response
     * 
     * @Route("/movie", name="moviedetails")
     */
    public function show() :Response
    {
        return $this->render('main/moviedetails.html.twig');
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
        return $this->render('main/favorites.html.twig');
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
        return $this->render('main/list.html.twig');
    }





}