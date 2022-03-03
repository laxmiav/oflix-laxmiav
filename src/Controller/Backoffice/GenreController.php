<?php



namespace App\Controller\Backoffice;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GenreController extends AbstractController
{
    /**
     * @Route("backoffice/genres/", name="backoffice_genres_browse", methods={"GET"})
     */
    public function list(GenreRepository $genreRepository): Response
    {
        // TODO ajouter une pagination

        return $this->render('backoffice/genre/list.html.twig', [
            'genre_list' => $genreRepository->findAll(),
        ]);
    }

    /**
     * @Route("backoffice/genres/{id}", name="backoffice_genres_read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Genre $genre): Response
    {
        return $this->render('backoffice/genre/read.html.twig', [
            'genre' => $genre,
        ]);
    }

    /**
     * @Route("backoffice/genres/{id}/edit", name="backoffice_genres_edit", methods={"GET", "POST"}, requirements={"id": "\d+"})
     */
    public function edit (Genre $genre, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();

            $this->addFlash('success', 'Genre modifié avec succès');
            $entityManager->flush();

            return $this->redirectToRoute('backoffice_genres_list');
        }

        return $this->render('backoffice/genre/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("backoffice/genres/add", name="backoffice_genres_add", methods={"GET", "POST"})
     */
    public function add (Request $request, ManagerRegistry $doctrine): Response
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();

            $entityManager->persist($genre);

            $this->addFlash('success', 'Genre ajouté avec succès');
            $entityManager->flush();

            return $this->redirectToRoute('backoffice_genres_list');
        }

        return $this->render('backoffice/genre/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("backoffice/genres/{id}/delete", name="delete", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function delete (Genre $genre, ManagerRegistry $doctrine): Response
    {
        // TODO penser à ajouter un tokenCSRF 

        $entityManager = $doctrine->getManager();
        $entityManager->remove($genre);
        $entityManager->flush();

        $this->addFlash('success', 'Genre supprimé avec succès');

        return $this->redirectToRoute('backoffice_genres_list');

    }




    
}
