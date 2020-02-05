<?php

namespace App\Controller;

use App\Entity\DbalConfig;
use App\Entity\Post;
use App\Form\ChoiceResurseType;
use App\Form\DbalConfigType;
use App\Repository\DbalConfigRepository;
use App\Service\ConnectorRemoteDb;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminPostController extends AbstractController
{


    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function postIndex(Request $request, EntityManagerInterface $em)
    {        //вывод всей таблицы
        $posts = $em->getRepository(Post::class)->findBy([]);

        $forms = [];
        foreach ($posts as $post) {
            //перенаправляю форму на роут 'admin_post_insert'
            $form = $this->createForm(ChoiceResurseType::class, null, [
                'action' => $this->generateUrl('admin_post_insert', [
                    'id' => $post->getId(),
                ]),
            ]);
            $forms[$post->getId()] = $form->createView();
        }


        return $this->render('admin_post/index.html.twig', [
            'controller_name' => 'AdminPostController',
            'posts' => $posts,
            'forms' => $forms,


        ]);

    }


    /**
     * @Route("/admin/post/insert/{id}", name="admin_post_insert")
     */
    public function insertDbRemote( Request $request, EntityManagerInterface $em, ConnectorRemoteDb $con, DbalConfigRepository $repository, Post $post)
    {
        $form = $this->createForm(ChoiceResurseType::class);
        $form->handleRequest($request);
        //получаю ресурс конектора (базу данных)
        $resource = $form->getData()->getResourse();

        //получаю свой edit - проверка на редактирование
        $edit = $em->getRepository(Post::class)->findOneBy(['id' => $post->getId()])->getEdited();

        if ($edit == false) {
            $this->addFlash('success', 'Пост не отредактирован');
            return $this->redirectToRoute('admin_post');
        }



        // конект к базе данных cfdtop_com
        $connect = $con->ConnectorRemoteDb($resource);

        // добавление данных в таблицу blog_posts
        $connect->insert('blog_posts', $repository->insertBlogPost($post));
        return $this->redirectToRoute('admin_post');


    }


}
