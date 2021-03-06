<?php
namespace App\Repository;
use App\Entity\VendorsEnGb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method VendorsEnGb|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorsEnGb|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorsEnGb[]    findAll()
 * @method VendorsEnGb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorsEnGbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorsEnGb::class);
    }
    // /**
    //  * @return VendorsEnGb[] Returns an array of VendorsEnGb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    /*
    public function findOneBySomeField($value): ?VendorsEnGb
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}