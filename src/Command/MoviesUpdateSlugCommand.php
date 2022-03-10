<?php

namespace App\Command;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Service\Myslugger;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MoviesUpdateSlugCommand extends Command
{
    protected static $defaultName = 'app:movies:update-slug';
    protected static $defaultDescription = 'Add a short description for your command';

    private $movieRepository;
    private $slugger;
    private $entityManager;

    public function __construct(MovieRepository $movieRepository, Myslugger $slugger, ManagerRegistry $doctrine)
    {
        parent::__construct();
        $this->movieRepository = $movieRepository;
        $this->slugger = $slugger;
        $this->entityManager = $doctrine->getManager();
    }

    protected function configure(): void
    {
        $this
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('movie', 'm', InputOption::VALUE_OPTIONAL, 'give an Id to slugify one movie')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        $movieId = null;
        if ($input->getOption('movie')) {
            $movieId = $input->getOption('movie');
            // ...
        }
        // dd($movieId);

        $allMovies = [];
        // récupérer tous les movies de la BDD
        // récupérer le repository de Movie en injectant la dépendance
        if (empty($movieId))
        {
            $allMovies = $this->movieRepository->findAll();
        }
        else 
        {
            $movie = $this->movieRepository->find($movieId);
            if (! is_null($movie))
            {
                $allMovies[] = $movie;
            }
        }

        // on va slugifier leur titre.
        foreach($allMovies as $currentMovie)
        {
            $this->slugifyMovie($currentMovie);
        }

        // écrire les modif en BDD
        $this->entityManager->flush();


        $io->success('Slugification Done !');

        return Command::SUCCESS;
    }

    private function slugifyMovie(Movie $movie)
    {
        // on a besoin de notre service pour sluggifier  => go injection de dépendance
        $slug = $this->slugger->slugify($movie->getTitle());
        $movie->setSlug($slug);
    }
}
