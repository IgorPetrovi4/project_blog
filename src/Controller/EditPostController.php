<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
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

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            $this->addFlash('success', 'Обьект обновлен');
            return $this->redirectToRoute('profile', ['id' => $post->getId()]);
        }

        return $this->render('edit_post/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),


        ]);
    }

}
