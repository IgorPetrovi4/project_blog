<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\DbalConfigRepository;
use App\Service\ConnectorRemoteDb;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminPostController extends AbstractController
{

    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function index(EntityManagerInterface $em)
    {
        //вывод всей таблицы
        $posts = $em->getRepository(Post::class)->findBy([]);


        return $this->render('admin_post/index.html.twig', [
            'controller_name' => 'AdminPostController',
            'posts' => $posts

        ]);

    }


    /**
     * @Route("/admin/post/insert{id}", name="admin_post_insert")
     */
    public function insertDbRemote(Request $request, EntityManagerInterface $em, ConnectorRemoteDb $con, DbalConfigRepository $repository, Post $post)
    {
        //получаем данные для отправки:

        // получаю свой title
        $title = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getTitle();
        // получаю свой content
        $text = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getContent();
        // получаю свой introduction
        $introduction = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getIntroduction();
        //получаю датту в формате 2020-01-23 09:28:00
        $created_on = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getCreatedOn()->format(date('Y-m-d H:i:s'));
        // проверка на время радактированимя - если не отредактированно ....
        if (empty($edited_on = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getEditedOn())) {
            $this->addFlash('success', 'Пост не отредактирован');
            return $this->redirectToRoute('admin_post');
        } else
            $edited_on = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getEditedOn()->format(date('Y-m-d H:i:s'));

        //проверка на время публикации - если не публиковалось ....
        if (empty($publish_on)) {
            $publish_on = '0000-00-00 00:00:00';
        } else
            //TODO отправка датты и времени публикации после написания контроллера публикаций
            $publish_on = '2020-01-23 09:28:00';

        // конект к базе данных cfdtop_com
        $connect = $con->ConnectorRemoteDb('cfdtop_com');

        // добавление данных в таблицу blog_posts
        $connect->insert('blog_posts', $repository->insertBlogPost($title, $introduction, $text, $publish_on, $created_on, $edited_on));


        return $this->redirectToRoute('admin_post');
    }


}
