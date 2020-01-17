<?php

namespace App\Controller;

use App\Entity\UserBase;
use App\Form\RegisterUserBaseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em)
    {
        // регистрация
        $userBase = new UserBase();
        $form = $this->createForm(RegisterUserBaseType::class, $userBase);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $encoder->encodePassword($userBase, $userBase->getPlainPassword());
            $userBase->setPassword($password);
            $userBase->setRoles(['ROLE_USER']);
            $em->persist($userBase);
            $em->flush();
            return $this->redirectToRoute('app_login');


        }

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            return $this->redirectToRoute('profile');
        }


        return $this->render('main/register.html.twig', [
            'controller_name' => 'MainController',
            'form'=>$form->createView()
        ]);
    }
}
