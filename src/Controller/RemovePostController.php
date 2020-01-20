<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RemovePostController extends AbstractController
{
    /**
     * @Route("/profile/remove/{id}", name="remove_post")
     */
    public function index(EntityManagerInterface $em)
    {


        $post_id = $em->getRepository(Post::class)->findBy(array(
            'id' => $this->getUser()->getId(),
        ));


        $em->remove($post_id);
        $em->flush();

        return $this->render('blog/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'post_user'=>$post_id
        ]);
    }

}
