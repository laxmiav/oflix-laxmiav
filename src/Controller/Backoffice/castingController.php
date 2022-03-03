<?php

namespace App\Controller\Backoffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CastingRepository;
use App\Repository\MovieRepository ;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Genre;
use App\Entity\Casting;
use App\Form\CastingType;

class castingController extends AbstractController
{
    /**
     * @Route("/backoffice/Casting", name="backoffice_casting_list")
     */
    public function list(CastingRepository $castingRepository): Response
    {
        $castings = $castingRepository->findAll();


        return $this->render('backoffice/casting/list.html.twig', [
            'castings' => $castings
        ]);
    }
    /**
     * @Route("/backoffice/Casting/add", name="backoffice_casting_add")
     */
    public function add(CastingRepository $castingRepository): Response
    {
        $castings = $castingRepository->find();


        return $this->render('backoffice/casting/add.html.twig', [
            'castings' => $castings
        ]);
    }
     /**
     * @Route("/backoffice/casting/{id}/read", name="backoffice_casting_read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(int $id, castingRepository $castingRepository): Response
    {
       

        
        $casting = $castingRepository->find($id);

        

        // on vérifie si l'identifiant existe dans le tableau
        if ( is_null($casting))
        {
            
            throw $this->createNotFoundException('The show does not exist');
        }

        return $this->render('backoffice/casting/read.html.twig', [
            'casting' => $casting,
            'casting_id' => $casting->getId(),
        ]);

        
    }
    
     /**
     * @Route("/backoffice/casting/{id}/edit", name="backoffice_casting_edit", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function edit(int $id, MovieRepository $movieRepository, castingRepository $castingRepository,ManagerRegistry $doctrine,Request $request): Response
    {
       

      
        $casting = $castingRepository->find($id);
        //$casting = new casting();
        $movie = $movieRepository->findOneWithAllData($id);
        // préparation des données
        $person = $casting->getPerson();
        $form = $this->createForm(CastingType::class, $casting);
        
        //dd($form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // récupérer les données
           $casting-> setMovie($movie);
           $casting-> setPerson($person);
            // valider les données
       
             $entityManager = $doctrine->getManager();
             $entityManager->flush();
            
           // dd( $casting);
            // // ajouter un flash message (facultatif)
            $this->addFlash('success', 'Votre casting a bien été modifié');
            // // rediriger
             return $this->redirectToRoute('backoffice_casting_read',['id' => $casting->getId()]);
        }

        return $this->renderform('backoffice/casting/edit.html.twig', [
            'form' => $form,
            'casting' => $casting,
            
        ]);

        
    }

    /**
     * @Route("/backoffice/casting/{id}/delete", name="backoffice_casting_delete", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function delete(Casting $casting, ManagerRegistry $doctrine): Response
    {
        // Un objet ParamConverter s'occupe de 
        // récupérer l'article en fonction de l'id fournit
        // si article non trouvé alors il renvoit une 404

        // si le code continue c'est que l'article a été trouvé et qu'il est dans l'objet $article

        // dire à doctrine de supprimer l'article
        $entityManager = $doctrine->getManager();
        $entityManager->remove($casting);
        
        // dire à doctrine d'exécuter la requête de suppression
        $entityManager->flush();

        // redirection
        return $this->redirectToRoute('backoffice_casting_list');
    }
}
