<?php 

namespace App\Controller;

use App\Model\ShowModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\MovieRepository;
use App\Form\ContactType;

class MainController extends AbstractController {


    /**
     * displays the homepage
     *
     * @return Response
     * 
     * @Route("/", name="homepage")
     */
    public function home( MovieRepository $movierepositary ) :Response
    {
        // TODO trouver une solution objet
        // préparation des données
        // require_once __DIR__ . '/../../sources/data.php';
        $shows = $movierepositary->findByMostRecentlyRelease(4);

        return $this->render('main/homepage.html.twig', [
            'show_list' => $shows
        ]);
    }

    /**
     * switchs theme between dark and light
     *
     * @return Response
     * 
     * @Route("/theme-switch", name="theme-switch")
     */
    public function switchTheme(SessionInterface $session, Request $request) :Response
    {
        // récupère la valeur de theme actuelle depuis la session ( par défaut c'est dark)
        $currentTheme = $session->get('colorTheme', 'dark');

        // si jamais c'est dark alors on met light dans le theme
        if ('dark' === $currentTheme)
        {
            $session->set('colorTheme', 'light');
        }
        // sinon on met dark dans le theme
        else
        {
            $session->set('colorTheme', 'dark');
        }

        // on veut récupérer le referer depuis la requete
        // var_dump($request->headers->get('referer'));
        // redirige vers la page qui a appelé le switch
        return $this->redirect($request->headers->get('referer'));
    }
     /**
     * displays the homepage
     *
     * @return Response
     * 
     * @Route("/acter/{id}", name="acter")
     */
    public function showacter(int $id, MovieRepository $movierepositary ) :Response
    {
        // TODO trouver une solution objet
        // préparation des données
        // require_once __DIR__ . '/../../sources/data.php';
        $showacter = $movierepositary->findOneWithPerson($id);

        return $this->render('main/acter.html.twig', [
            'show_acteur' => $showacter
        ]);
    }
       /**
     * displays the contact
     *
     * @return Response
     * 
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     */
    public function contact(Request $request) :Response
    {
        // préparation des données
        $form = $this->createForm(ContactType::class);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // récupérer les données

            // valider les données

            // traiter le formulaire
            mail('gbaltide@sfr.fr', "contact site oflix", 'Un contact a essayé de vous joindre avec les informations suivantes .. on concatène les valeurs recues');

            // ajouter un flash message (facultatif)
            $this->addFlash('success', 'Votre message a bien été envoyé');
            // rediriger
            return $this->redirectToRoute('homepage');
        }

        return $this->renderForm('main/contact.html.twig', [
            'form' => $form
        ]);
    }
    

}