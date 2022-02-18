<?php

namespace App\Controller;
use App\Model\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
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
