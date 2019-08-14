<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_company', TextType::class, [
                'label' => 'name_company :',
                'attr' => [
                    'placeholder' => 'name_company'

                ]
            ])
            ->add('name_director', TextType::class, [
                'label' => 'name_director :',
                'attr' => [
                    'placeholder' => 'name_director'

                    ]
                ])
            ->add('siret_company', TextType::class, [
                    'label' => 'siret_company :',
                    'attr' => [
                        'placeholder' => 'siret_company'
    
                        ]
                    ])
                    ->add('phone_company', TextType::class, [
                        'label' => 'phone_company',
                        'attr' => [
                            'placeholder' => 'sphone_company'
        
                            ]
                        ])
                        ->add('email_company', TextType::class, [
                            'label' => 'email_company',
                            'attr' => [
                                'placeholder' => 'email_company'
            
                                ]
                            ])
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}