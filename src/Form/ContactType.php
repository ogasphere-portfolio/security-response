<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                "label" => "Votre Nom"
            ])
            ->add('email',EmailType::class, [
                "label" => "Votre adresse e-mail"
            ])
            ->add('phone',TextType::class, [
                "label" => "Votre téléphone"
                ])
            ->add('message', TextareaType::class, [
                "label" => "Message"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here            
        ]);
    }
}
