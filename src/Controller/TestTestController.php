<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\DbalConfigRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestTestController extends AbstractController
{
    /**
     * @Route("/test/test", name="test_test")
     */
    public function index(DbalConfigRepository $dbalConfigRepository)
    {

        $r = $dbalConfigRepository->titleData();


        dd($r);

        return $this->render('test_test/index.html.twig', [
            'controller_name' => 'TestTestController',
        ]);
    }
}
