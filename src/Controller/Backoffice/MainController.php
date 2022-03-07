<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MainController extends AbstractController
{
    /**
     * @Route("/backoffice/main", name="backoffice_homepage")
     * @IsGranted("ROLE_MANAGER")
     */
    public function index(): Response
    {
        return $this->render('backoffice/main/home.html.twig');
    }
}
