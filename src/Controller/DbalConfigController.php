<?php

namespace App\Controller;

use App\Entity\DbalConfig;
use App\Form\DbalConfigType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DbalConfigController extends AbstractController
{
    /**
     * @Route("/dbal/config", name="dbal_config")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        // добавление данных
        $form_dbal = $this->createForm(DbalConfigType::class);
        $form_dbal->handleRequest($request);

        if ($form_dbal->isSubmitted() && $form_dbal->isValid()) {
            $post = $form_dbal->getData();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Connect добавлен!');
            return $this->redirectToRoute('profile');

        }

        $dbalConfig = $em->getRepository(DbalConfig::class)->findBy([]);

        return $this->render('dbal_config/index.html.twig', [
            'controller_name' => 'DbalConfigController',
            'formDbal'=>$form_dbal->createView(),
            'dbalConfigs'=>$dbalConfig
        ]);
    }
}
