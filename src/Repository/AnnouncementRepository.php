<?php

namespace App\Repository;

use App\Entity\Announcement;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Announcement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announcement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announcement[]    findAll()
 * @method Announcement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }


    
    
    
    /**
     * Récupère toutes les informations liées au tvShow demandé
     *@return Announcement
     */
    public function findByRecrutement() :Announcement
    {
        $entityManager = $this->getEntityManager();

        // $select = " SELECT ";
        // $from = " FROM announcement a";
        // $join = "INNER JOIN category ON announcement.category_id = category.id ";
        // $where = "where category.name = 'RECRUTEMENT'";

        $dqlQuery = " SELECT a
        FROM App\Entity\Announcement a
        INNER JOIN App\Entity\Category c 
        ON a.category_id = c.id
        WHERE c.name = 'RECRUTEMENT'"; 

        $query = $entityManager->createQuery(
            $dqlQuery
        );
         
        
        // $dqlQuery = $select . $from . $join . $where;

        //dd($dqlQuery);
        
        $query = $entityManager->createQuery($dqlQuery);

        // returns the selected Announcement Object
        return $query->getResult();
    }

    // select *
    // from announcement
    // INNER JOIN category ON announcement.category_id = category.id
    // where category.name = "RECRUTEMENT"
    /*
    public function findOneBySomeField($value): ?Announcement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
