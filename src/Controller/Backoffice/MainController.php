<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/backoffice/main", name="backoffice_homepage")
     */
    public function index(): Response
    {
        return $this->render('backoffice/main/home.html.twig');
    }
}
