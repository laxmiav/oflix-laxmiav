<?php

namespace App\Controller;

use App\Model\ShowModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="movie_api")
     */
    public function index(): Response
    {
        // préparation des données
        // require_once __DIR__ . '/../../sources/data.php';
        // $showModel = new ShowModel();
        $shows = ShowModel::getShowList();

        return $this->json($shows);
    }
}
