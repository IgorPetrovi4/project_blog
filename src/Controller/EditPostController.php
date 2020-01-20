<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Profile;
use App\Form\PostFormType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditPostController extends AbstractController
{
    /**
     * @Route("/edit/post/{id}", name="edit_post")
     */
    public function index(Request $request, EntityManagerInterface $em, Post $post)
    {


        // форма изменения информации
        $form = $this->createForm(PostFormType::class, $post);
       $form->handleRequest($request);
        dd($form);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            $this->addFlash('success', 'Обьект обновлен');
            return $this->redirectToRoute('profile', ['id' => $post->getId()]);
        }

        return $this->render('blog/profile.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),


        ]);
    }

}
