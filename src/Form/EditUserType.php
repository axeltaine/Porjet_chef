<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name_user', TextType::class,[
            'label' => 'Nom utilisateur',
            'required'=>true
        ])
        ->add('email_user', TextType::class,[
            'label' => 'Adresse mail utilisateur',
            'required'=>true
        ])
        ->add('avatar', FileType::class, [
            'data_class' => null,
            'required'=>true
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}