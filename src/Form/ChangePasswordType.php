<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [

                'attr' => [
                    "class" => "input mt-3"
                ]
            
            ])
            ->add('firstname', TextType::class, [

                'attr' => [
                    "class" => "input mt-3"
                ]
            ])
            ->add('lastname', TextType::class, [

                'attr' => [

                    "class" => "input mt-3"
                ]
            ])
            ->add('old_password', PasswordType::class, [
                "mapped" => false,
                "label" => "Mot de passe actuel",
                'attr' => [

                    "class" => "input mt-3"
                ]
            ])
             ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => "Les mots de passe ne sont pas identiques",
                'label' => "Nouveau mot de passe",
                'required'=> true,
                "first_options" => ['label' => '    Nouveau Mot de passe', "attr" => ["class" => "input mt-3"]],
                "second_options" => ['label' => "Confirmez votre mot de passe", "attr" => ["class" => "input mt-3"]],
                // 'attr' => [
                //     "placeholder" => "Votre mot de passe",
                //     "class" => "input"
                // ]
            ])
             ->add('submit', SubmitType::class, [
                "label" => "Sauvegarder",
                'attr' => [

                    "class" => "button is-link mt-5"
                ]
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
