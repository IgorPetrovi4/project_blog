<?php

namespace App\Form;

use App\Entity\DbalConfig;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceResurseType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('resourse', EntityType::class, [
                'class' => DbalConfig::class,
                'placeholder' => 'Ресурс...',
                'label' => false,
                'attr' => array('style' => 'width: 120px')
            ])
            ->add('submit', SubmitType::class, [

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DbalConfig::class,
        ]);
    }
}
