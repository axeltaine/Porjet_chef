<?php

namespace App\Form;

use App\Entity\Projet;
use App\Form\CompanyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_projet', TextType::class, [
                'label' => 'Nom du projet :'
                
            ])
            ->add('company', CompanyType::class, [
                'label' => 'Nom de société :'
            ])
            ->add('desc_projet', TextareaType::class, [
                'label' => 'Description :'
                ])
            ->add('name_domain', TextType::class, [
                    'label' => 'Domaine :'
                    ])
            ->add('img_projet', FileType::class, [
                'label' => 'Image :',
                'attr' => [
                    'placeholder' => 'Image'

                    ]
                ])
                ->add('logo_projet', FileType::class, [
                    'label' => 'Logo :'
                    ])
            ->add('doc_projet', FileType::class, [
                    'label' => 'Document :'
                    ])
                    ->add('date_start', DateType::class, [
                        'label' => 'Date de début  :',
                        'widget' => 'single_text'
                        ])
                        ->add('date_end', DateType::class, [
                            'label' => 'Date de fin  :',
                            'widget' => 'single_text'
                            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}