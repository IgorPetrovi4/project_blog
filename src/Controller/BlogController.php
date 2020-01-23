<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function post(Request $request, EntityManagerInterface $em)
    {

        // добавление данных
        $form_blog = $this->createForm(PostFormType::class);
        $form_blog->handleRequest($request);

        if ($form_blog->isSubmitted() && $form_blog->isValid()) {
            $post = $form_blog->getData();
            $post->setUser($this->getUser());
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Данные добвленны в базу данных');
            return $this->redirectToRoute('profile');
        }

        return $this->render('blog/post.html.twig', [
            'controller_name' => 'BlogController',
            'form_blog'=>$form_blog->createView()

        ]);
    }
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, EntityManagerInterface $em)
    {

        $user = $this->getUser();
        if (!$user){
            return $this->redirectToRoute('register');
        }

        if ($this->isGranted('ROLE_USER')) {

            // вывод  таблицы User id
            $posts = $em->getRepository(Post::class)->findBy(array('user' => $this->getUser()->getId()));

        }



        if ($this->isGranted('ROLE_ADMIN')) {
            // вывод всей таблицы всех user
            return $this->redirectToRoute('admin_post');

        }


        return $this->render('blog/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'posts'=>$posts
        ]);
    }





}
