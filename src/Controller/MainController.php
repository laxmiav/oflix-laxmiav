<?php 

namespace App\Controller;

use App\Model\ShowModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\MovieRepository;

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
        $shows = $movierepositary->findall();

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

}