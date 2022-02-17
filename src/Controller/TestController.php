<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController {

    public function homepage() 
    {
        $response = new Response('<h1>Hello Symfo</h1>');

        // 1ere règle de Symfony : une action doit retourner un objet de la classe Symfony\Component\HttpFoundation\Response
        return $response;
    }

    public function testJson() 
    {
        $data = [
            'coucou' => "c'est dla balle",
            'nom' => 'grego',
            'chevelu' => false,
        ];

        // $this->json renvoie un objet de la classe JsonResponse qui est enfant de la classe Response
        // donc on respecte la 1ère règle de Symfony
        return $this->json($data);
    }
}