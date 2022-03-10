<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Service\Myslugger;
use Doctrine\Persistence\ManagerRegistry;

class MoviesFindFirstCommand extends Command
{
    protected static $defaultName = 'app:movies:find-first';
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
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $movies = $this->movieRepo->findAll();

        $badMoviesId = [];
        foreach($movies as $currentMovie)
        {
            // si le slug commence par slug-
            if (strpos($currentMovie->getSlug(), 'slug-') === 0)
            {
                //$badMoviesId[] = $currentMovie->getId();
                echo $currentMovie->getId() . PHP_EOL;
            }
        }

        dump($badMoviesId);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
