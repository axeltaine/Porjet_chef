<?php

namespace App\Form;

use App\Entity\Data;
use App\Form\EditdataType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditdataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('visitor', IntegerType::class, [
            'label' => 'Nombre de visiteurs uniques :'
        ])
        ->add('page', IntegerType::class, [
            'label' => 'Nombre de pages vues :'
        ])
        ->add('keyword1', TextType::class, [
            'label' => 'Mot clé 1 :'
        ])
        ->add('keyword2', TextType::class, [
            'label' => 'Mot clé 2 :'
        ])
        ->add('keyword3', TextType::class, [
            'label' => 'Mot clé 3 :'
        ])
        ->add('keyword4', TextType::class, [
            'label' => 'Mot clé 4 :'
        ])
        ->add('advice', TextareaType::class, [
            'label' => 'Conseils pour le projet :'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Data::class,
        ]);
    }
}
