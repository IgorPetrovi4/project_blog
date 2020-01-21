<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RemovePostController extends AbstractController
{
    /**
     * @Route("/profile/remove/{id}", name="remove_post")
     */
    public function index( EntityManagerInterface $em, Post $post)
    {
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('profile');

    }

}
