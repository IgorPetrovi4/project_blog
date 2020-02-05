<?php

namespace App\Repository;

use App\Entity\DbalConfig;
use App\Entity\Post;
use App\Service\ConnectorRemoteDb;
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
    private $con;
   public function __construct(ManagerRegistry $registry, ConnectorRemoteDb $con)
    {
        parent::__construct($registry, DbalConfig::class);
        $this->con = $con;


    }


    //получение последнего значения meta_id
    /*public function revizionDataMax(){
        // конект к базе данных cfdtop_com
        $connect = $this->con->ConnectorRemoteDb('cfdtop_com');
        $sql = "SELECT revision_id FROM blog_posts ORDER BY revision_id DESC ";
        $stmt = $connect->fetchColumn($sql);
        return  $revision_id = $stmt+1;
    }*/



    public function insertBlogPost( Post $post) :array
    {
        // получаю свой title
        $title = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getTitle();
        // получаю свой content
        $text = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getContent();
        // получаю свой introduction
        $introduction = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getIntroduction();
        //получаю датту создания поста в формате 2020-01-23 09:28:00
        $created_on = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getCreatedOn()->format(date('Y-m-d H:i:s'));
        //получаю датту редактирования поста в формате 2020-01-23 09:28:00
        $edited_on_object =$this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getEditedOn();
        if (empty($edited_on_object)) {
            $edited_on = '0000-00-00 00:00:00';
        } else
        $edited_on = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getEditedOn()->format(date('Y-m-d H:i:s'));
        //получаю датту публикации поста в формате 2020-01-23 09:28:00
        $publish_on_object = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getPublishOn();
        if (empty($publish_on_object)) {
            $publish_on = '0000-00-00 00:00:00';
        } else
        $publish_on = $this->_em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getPublishOn()->format(date('Y-m-d H:i:s'));


        $cfdtop_com_blog_posts = [
            'id'=>'1',
            'category_id'=>'1',
            'user_id' => '1',
            'language'=>'ru',
            'title'=> $title,
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


    public function insertMeta(){
        $cfdtop_com_meta = [
            'id'=>'',
            'keywords'=>'',
            'keywords_overwrite'=>'',
            'description'=>'',
            'description_overwrite'=>'',
            'title'=>'',
            'title_overwrite'=>'',
            'url'=>'',
            'url_overwrite'=>'',
            'custom'=>'',
            'data'=>'',
            'seo_follow'=>'',
            'seo_index'=>'',





        ];


        return $cfdtop_com_meta;
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
