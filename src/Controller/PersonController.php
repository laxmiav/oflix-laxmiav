<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/person", name="person_")
 */
class PersonController extends AbstractController
{
    /**
     * @Route("/{id}", name="show", requirements={"id"="\d+"}, methods="GET")
     */
    public function show($id, PersonRepository $personRepository): Response
    {

        $person = $personRepository->findOneByIdWithCastingAndMovie($id);

        // TODO gérer la 404
        if (is_null($person))
        {
            throw $this->createNotFoundException('Acteur non trouvé');
        }

        return $this->render('person/show.html.twig', [
            'person' => $person,
        ]);
    }
}
