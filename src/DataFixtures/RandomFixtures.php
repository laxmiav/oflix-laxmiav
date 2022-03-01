<?php

namespace App\DataFixtures;

use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RandomFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
            $person->setFirstname('Prénom ' . $i);
            $person->setLastname('Nom ' . $i);
            
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
            $movie->setSummary('Summary ' . $i);
            $movie->setSynopsis('Synopsis' . $i);
            $movie->setDuration(100 + $i);
            $movie->setRating(3.2);
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
