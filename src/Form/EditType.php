<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_projet', TextType::class, [
                'label' => 'Nom du projet :'
            ])
            ->add('desc_projet', TextareaType::class, [
                'label' => 'Description du projet :'
            ])
            ->add('img_projet', FileType::class, [
            'label' => 'Image du projet :',
            'data_class' => null,
            'required'=>true
        ])
            ->add('name_domain')
            ->add('logo_projet', FileType::class, [
            'label' => 'Logo du projet :',
            'data_class' => null,
            'required'=>true
        ])
            ->add('doc_projet', FileType::class, [
            'label' => 'Document du projet :',
            'data_class' => null,
            'required'=>true
        ])
            ->add('date_start', DateType::class, [
                'label' => 'Date de début  :',
                'widget' => 'single_text'
                ])
            ->add('date_end', DateType::class, [
                'label' => 'Date de début  :',
                'widget' => 'single_text'
                ])
            ->add('position', ChoiceType::class, [
                'choices'  => [
                    'Phase-1.1' => 0,
                    'Phase-1.2' => 1,
                    'Phase-1.3' => 2,
                    'Phase-2.1' => 3,
                    'Phase-2.2' => 4,
                    'Phase-2.3' => 5,
                    'Phase-3.1' => 6,
                    'Phase-3.2' => 7,
                    'Phase-3.3' => 8,
                    'Phase-4.1' => 9,
                    'Phase-4.2' => 10,
                    'Phase-4.3' => 11,
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
