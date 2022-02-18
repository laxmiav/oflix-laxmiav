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
     * @Route("/movie/{id}", name="moviedetails", requirements={"id"="\d+"})
     */
    public function show(int $id) :Response

    {
        $movie = new Data;
        
        $flim = $movie->getshows();
        return $this->render('movie/moviedetails.html.twig',['flim' => $flim[$id]]);
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
    /**
     * displays the api 
     *
     * @return Response
     * 
     * @Route("/api", name="api")
     */
    public function api() :Response
    {
        $movie = new Data;
        
        $data = $movie->getshows();
        return $this->json($data);
    }

    




}