<?php 

namespace App\Controller;
use App\Model\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController {


    /**
     * displays the homepage
     *
     * @return Response
     * 
     * @Route("/", name="homepage")
     */
    public function home() :Response
    {
          $movie = new Data;
          $flim = $movie->getshows();
        return $this->render('main/homepage.html.twig',['flim' => $flim]);
    }

}