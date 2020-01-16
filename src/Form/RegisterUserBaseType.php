<?php

namespace App\Form;

use App\Entity\UserBase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserBaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label'=>'Ваш email будет использован как логин для входа'])
            ->add('plainPassword', RepeatedType::class, [
                'type'=> PasswordType::class,
                'first_options'=>['label'=>'Пароль'],
                'second_options'=>['label'=>'Повторить пароль']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserBase::class,
        ]);
    }
}
