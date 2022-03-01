<?php

namespace App\Repository;

use App\Entity\Movie;
use App\Entity\Casting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Movie $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Movie $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findOneWithAllData($movieId): ?Movie
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, g, c, p
            FROM App\Entity\Movie m
            JOIN m.genres g
            JOIN m.castings c
            JOIN c.person p 
            WHERE m.id = :id'
        );
        $query->setParameter('id', $movieId);

        // returns the movie or null if not found
        return $query->getOneOrNullResult();

    }

    public function findAllOrderByTitle()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Movie m
            ORDER BY m.title ASC
            '
        );

        // returns the movie or null if not found
        return $query->getResult();
    }                               
    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findAllOrderByDateDescWithLimit($limit = 10) : ?array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\Movie m
            ORDER BY m.releaseDate DESC
            '
        );

        $query->setMaxResults($limit);
        // returns the movie or null if not found
        return $query->getResult();
    }

   /**
     *
     * @param integer $limit
     * @return void
     */
    public function findByMostRecentlyRelease($limit = 10)
    {
        $entityManager = $this->getEntityManager(); 

        $query = $entityManager->createQuery(
            'SELECT m, g, c, p
            FROM App\Entity\Movie m
            JOIN m.genres g
            JOIN m.castings c
            JOIN c.person p 
            ORDER BY m.releaseDate DESC'
        ); 
        
        $query->setMaxResults($limit);
        //$query->setParameter('shows_list', $showsList);
        
        // returns the movies orderedBy Title
        /* Attention si on fait des jointures, on obtient plusieurs lignes pour un meme film
         * du coup le limit 2 par exemple n'aura que les informations du 1er film avec ses genres
         * Le paginator permet de pallier à ce problème \o/ Merci @Julien L
        */
        return new Paginator($query);

    }


}
