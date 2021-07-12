<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    "placeholder" => "Votre nom",
                    "class" => 'input'
                ]
            ])
            ->add('lastname', TextType::class, [
            
                'attr' => [
                    "placeholder" => "Votre prenom",
                    "class" => "input"
                ]
            ])
            ->add('email', EmailType::class, [

                'attr' => [
                    "placeholder" => "Votre adresse email",
                    "class" => "input"
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Les mots de passe ne sont pas identiques",
                'required'=> true,
                "first_options" => ['label' => 'Mot de passe', "attr" => ["class" => "input"]],
                "second_options" => ['label' => "Confirmez votre mot de passe", "attr" => ["class" => "input"]],
                // 'attr' => [
                //     "placeholder" => "Votre mot de passe",
                //     "class" => "input"
                // ]
            ])
           
            ->add('submit', SubmitType::class, [
                "label" => "Inscription",
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
