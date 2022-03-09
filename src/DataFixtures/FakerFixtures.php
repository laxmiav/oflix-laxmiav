<?php


namespace App\DataFixtures;

use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\String\Slugger\SluggerInterface;

use Faker\Factory;

class FakerFixtures extends Fixture
{



    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }




    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->seed(806);
        // préparer les données


      
        



        // créer une liste de genre et les stocker dans un tableau
        $genres = [
            'Action',
            'Animation',
            'Aventure',
            'Comédie',
            'Dessin animé',
            'Documentaire',
            'Drame',
            'Espionnage',
            'Famille',
            'Fantastique',
            'Historique',
            'Policier',
            'Romance',
            'Science-fiction',
            'Thriller',
            'Western',
        ];

        // va contenir les objets genre que l'on a créé
        $genreObjects = [];

        foreach ($genres as $currentGenre) {
            $genre = new Genre();
            $genre->setName($currentGenre);

            $genreObjects[] = $genre;
            $manager->persist($genre);
        }

        // créer une liste de personne et les stocker dans un tableau
        $nbActeurs = 50;
        $personObjects = [];
        for ($i = 0; $i < $nbActeurs; $i++) {
            $person = new Person();
            $person->setFirstname($faker->firstName());
            $person->setLastname($faker->lastName());

            $personObjects[] = $person;
            $manager->persist($person);
        }

        // créer une liste de movie 
        // pour chaque movie piocher un nombre de genre aléatoire à associer
        // pour chaque movie piocher un nombre de personnes aléatoire pour créer des castings
        $nbMovie = 20;

        $types =[
            'movie',
            'tvshow',
        ];
        for ($movieCount = 0; $movieCount < $nbMovie; $movieCount++) {
            // ajouter le movie
            $movie = new Movie();
            $movie->setTitle('Titre '  . $movieCount);
            $typeIndex = rand(0, 1);
            $movie->setType($types[$typeIndex]);
            $movie->setSummary($faker->sentence());
            $movie->setSynopsis($faker->paragraph());
            $movie->setDuration($faker->numberBetween(45, 185));
            $movie->setRating($faker->randomFloat(1, 0, 5));
            $movie->setPoster('https://picsum.photos/id/' . ( $movieCount + 1 ) . '/200/300');
            $movie->setReleaseDate(new DateTime());

            // ajouter les associations avec Genre
            for ($i = 0; $i <= rand(1, 5) ; $i++)
            {
                $randomIndex = array_rand($genreObjects);
                $movie->addGenre($genreObjects[$randomIndex]);
            }

            // Ajouter des castings
            for ($i = 0; $i <= rand(5, 25); $i++)
            {
                $casting = new Casting();

                $casting->setMovie($movie);

                $randomIndex = array_rand($personObjects);
                $casting->setPerson($personObjects[$randomIndex]);

                $casting->setRole($this->generateRandomString(rand(6,10)));
                $casting->setCreditOrder($i);

                $manager->persist($casting);
            }

            // dire à Doctrine de gérer le nouvel objet
            $manager->persist($movie);
        }

        $user = new User();
        $user->setEmail('admin@admin.com');
        // password is admin
        $user->setPassword('$2y$13$FBvw1Kh9IO9jFSFOxE1vD.Fk0avi1mLnt0MXGS2gAEAmoeUCj2XoS');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('manager@manager.com');
        // password is manager
        $user->setPassword('$2y$13$spQFGrDmbnqFBF.HIKWQueqP0hYoUEDWvMKwx9Dd2VlbLj5G9XktO');
        $user->setRoles(['ROLE_MANAGER']);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@user.com');
        // password is user
        $user->setPassword('$2y$13$Q4jpOKImtja0WRY4rUSjEOcyjFZh5DqLTkpuOJWnh8XoMBPbHdlZC');
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $manager->flush();
    }

    /**
     * @param int $length
     * @param string $abc
     * @return string
     */
    public function generateRandomString($length, $abc = "abcdefghijklmnopqrstuvwxyz")
    {
        return substr(str_shuffle($abc), 0, $length);
    }
}
