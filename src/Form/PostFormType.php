<?php

namespace App\Form;

use App\Controller\SecurityController;
use App\Entity\Post;
use App\Entity\UserBase;
use App\Repository\UserBaseRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class PostFormType extends AbstractType
{

    // получаю обьект текущего User в PostForm
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content');


        // ставлю прослушиватель событий
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
             $form = $event->getForm();
             $post =$event->getData();

             $user = $this->security->isGranted('ROLE_ADMIN');

            if (!empty($post)&& $user  )  {
                $form->add('edited');
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
