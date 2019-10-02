<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EditcompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name_company', TextType::class, [
            'label' => 'Nom de la Société :'
        ])
        ->add('name_director', TextType::class, [
            'label' => 'Nom du directeur :'
            ])
        ->add('siret_company', TextType::class, [
                'label' => 'Siret de la Société :'
                ])
        ->add('phone_company', TextType::class, [
                    'label' => 'Téléphone de la Société'
                    ])
        ->add('email_company', TextType::class, [
                        'label' => 'Adresse mail de la Société'
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
