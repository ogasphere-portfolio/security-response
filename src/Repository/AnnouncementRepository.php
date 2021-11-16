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
     *@return Announcement[]
     */
    public function findByRecrutement() :array
    {
        $entityManager = $this->getEntityManager();

        // $select = " SELECT ";
        // $from = " FROM announcement a";
        // $join = "INNER JOIN category ON announcement.category_id = category.id ";
        // $where = "where category.name = 'RECRUTEMENT'";

        $dqlQuery = " SELECT a
        FROM App\Entity\Announcement a
        INNER JOIN App\Entity\Category c 
        WITH a.category = c.id
        WHERE c.name = 'Recrutement'
        ORDER BY a.created_at DESC"; 
        $query = $entityManager->createQuery(
            $dqlQuery
        );
         
        
        // $dqlQuery = $select . $from . $join . $where;

        //dd($dqlQuery);
        
        $query = $entityManager->createQuery($dqlQuery);

        // returns the selected Announcement Object
        return $query->getResult();
    }

    /**
     * Récupère toutes les informations liées au tvShow demandé
     *@return Announcement[]
     */
    public function findByAnnouncementByEnterprise() :array
    {
        $entityManager = $this->getEntityManager();

        // $select = " SELECT ";
        // $from = " FROM announcement a";
        // $join = "INNER JOIN category ON announcement.category_id = category.id ";
        // $where = "where category.name = 'RECRUTEMENT'";

        $dqlQuery = " SELECT a
        FROM App\Entity\Announcement a
        INNER JOIN App\Entity\Category c 
        WITH a.category = c.id
        WHERE c.name <> 'Recrutement'
        ORDER BY a.created_at DESC"; 

        $query = $entityManager->createQuery(
            $dqlQuery
        );
         
       
        // $dqlQuery = $select . $from . $join . $where;

        //dd($dqlQuery);
        
        $query = $entityManager->createQuery($dqlQuery);

        // returns the selected Announcement Object
        return $query->getResult();
    }
}
