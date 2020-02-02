<?php

namespace App\Form;


use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            ->add('content', TextareaType::class, [

                'attr' => ['rows' => 10

                ]
            ])
            ->add('introduction', TextareaType::class, [
                'attr' => ['rows' => 5

                ]
            ]);


        // ставлю прослушиватель событий
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $form = $event->getForm();
            $post = $event->getData();

            $user = $this->security->isGranted('ROLE_ADMIN');
            //TODO написать проверку если USER_ADMIN добавляет пост то галочка проверки не стоит (массив не пустой из за времени ).
            if (!empty($post) && $user) {
                $form->add('edited', CheckboxType::class, [
                    'label' => 'Отредактированно',
                    'required' => false

                ]);
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
