<?php

namespace App\Repository;

use App\Entity\Enterprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Enterprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enterprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enterprise[]    findAll()
 * @method Enterprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnterpriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enterprise::class);
    }


    public function searchByCity(string $city): array
    {
        $entityManager = $this->getEntityManager();

        $select = " SELECT e ";
        $from = " FROM App\Entity\Enterprise e ";
        $where = " WHERE e.city like :city ";

        $dqlQuery = $select . $from . $where;
        
        // on va utiliser le DQL ( Doctrine Query Language)
        $query = $entityManager->createQuery(
            $dqlQuery
        )->setParameter('city', '%' . $city . '%');

        // returns the selected Enterprise Object
        return $query->getResult();
    }

    // /**
    //  * @return Enterprise[] Returns an array of Enterprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enterprise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
