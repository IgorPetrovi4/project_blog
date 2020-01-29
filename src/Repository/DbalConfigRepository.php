<?php

namespace App\Repository;

use App\Entity\DbalConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method DbalConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method DbalConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method DbalConfig[]    findAll()
 * @method DbalConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DbalConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DbalConfig::class);
    }



    public function insertBlogPost($revision_id, $meta_id,$title,$introduction,$text,$publish_on,$created_on, $edited_on) :array
    {
        $cfdtop_com_blog_posts = [
            'id'=>'1',
            'revision_id'=>$revision_id,
            'category_id'=>'1',
            'user_id' => '1',
            'meta_id'=>$meta_id,
            'language'=>'ru',
            'title'=>$title,
            'introduction'=>$introduction,
            'text'=>$text,
            'image'=>'',
            'status'=>'active',
            'publish_on'=>$publish_on,
            'created_on'=>$created_on,
            'edited_on'=>$edited_on,
            'hidden'=>'0',
            'allow_comments'=>'1',
            'num_comments'=>'0'
            ]
            ;
        return $cfdtop_com_blog_posts;
    }

    // /**
    //  * @return DbalConfig[] Returns an array of DbalConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DbalConfig
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
