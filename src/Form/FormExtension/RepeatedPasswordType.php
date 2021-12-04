<?php
namespace App\Form\FormExtension;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RepeatedPasswordType extends AbstractType
{
  public function getParent(): string
  {
    return RepeatedType::class;
  }
  
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'type' => PasswordType::class,
      'required' => true,
      // instead of being set onto the object directly,
      // this is read and encoded in the controller
      'mapped' => false,
      'first_options'  => ['label' => 'Mot de passe *'],
      'second_options' => ['label' => 'Confirmer le mot de passe *'],

      'attr' => ['autocomplete' => 'new-password'],
      'constraints' => [
          new NotBlank([
              'message' => 'Minimum huit caractères, une lettre, un chiffre et un caractère spécial.',
          ]),
          new Length([
              'min' => 6,
              'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
              // max length allowed by Symfony for security reasons
              'max' => 4096,
          ]),
      ],
  ]);
  }
}