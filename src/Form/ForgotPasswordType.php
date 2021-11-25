<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ForgotPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', RepeatedType::class, [
                'type'              => EmailType::class,
                'invalid_message'   => "Les adresses e-mail doivent être identiques.",
                'required'          => true,
                'constraints'       => [
                    new NotBlank(),
                    new Email()
                ],
                'first_options'     => [
                    'label' => 'Saisir votre adresse e-mail'
                ],
                'second_options'    => [
                    'label' => 'Confirmez votre adresse e-mail'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
