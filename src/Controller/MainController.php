<?php 

namespace App\Controller;

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
        return $this->render('main/homepage.html.twig');
    }

}