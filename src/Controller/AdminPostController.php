<?php

namespace App\Controller;

use App\Repository\DbalConfigRepository;
use App\Service\ConnectorRemoteDb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminPostController extends AbstractController
{

    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function insertDbRemote(ConnectorRemoteDb $con, DbalConfigRepository $repository)
    {
        $revision_id = 14;
        $meta_id = 45;
        $title = '';
        $introduction = '';
        $text = '';
        $publish_on = '';
        $created_on = '';
        $edited_on = '';

        // конект к базе данных cfdtop_com
        $connect = $con->ConnectorRemoteDb('cfdtop_com');


        // добавление данных в таблицу blog_posts
        $connect->insert('blog_posts', $repository->insertBlogPost($revision_id, $meta_id, $title, $introduction, $text, $publish_on, $created_on, $edited_on));

        // вывод данных из удаленной базы
        //$users = $connect->fetchAll('SELECT * FROM blog_posts ');
        //dd($users);

        return $this->render('admin_post/index.html.twig', [
            'controller_name' => 'AdminPostController',

        ]);

    }


}
