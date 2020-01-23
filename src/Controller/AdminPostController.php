<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\UserBase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPostController extends AbstractController
{
    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function index(EntityManagerInterface $em)
    {

        $posts = $em->getRepository(Post::class)->findBy([]);


        return $this->render('admin_post/index.html.twig', [
            'controller_name' => 'AdminPostController',
            'posts' => $posts

        ]);

    }
}
