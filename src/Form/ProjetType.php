<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_projet', TextType::class, [
                'label' => 'Nom du projet',
                'attr' => [
                    'placeholder' => 'Nom'

                ]
            ])
            ->add('desc_projet', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description'

                    ]
                ])
            ->add('img_projet', FileType::class, [
                'label' => 'Image',
                'attr' => [
                    'placeholder' => 'Image'

                    ]
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
