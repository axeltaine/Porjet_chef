<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_user', TextType::class,[
                'label' => 'Nom utilisateur',
                'required'=>true
            ])
            ->add('mdp_user', TextType::class,[
                'label' => 'Mot de passe utilisateur',
                'required'=>true
            ])
            ->add('email_user', TextType::class,[
                'label' => 'Adresse mail utilisateur',
                'required'=>true
            ])
            ->add('avatar', FileType::class, [
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
