<?php

namespace App\Form;

use App\Entity\Data;
use App\Form\EditdataType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EditdataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('visitor')
        ->add('page')
        ->add('keyword1')
        ->add('keyword2')
        ->add('keyword3')
        ->add('keyword4')
        ->add('advice')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Data::class,
        ]);
    }
}
