<?php

namespace App\Form\BackOffice;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci de saisir une adresse email"
                    ])
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]

            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Membre' => 'ROLE_MEMBER',
                    'Entreprise' => 'ROLE_ENTERPRISE',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class, 
                'required' => true,
    
                // comme on veut appliquer des règles de gestion non standard
                // on précise à symfony que cette valeur ne correspond à aucun 
                // champ de notre objet
                //!\ il faudra gérer la valeur saisie dans le controleur
                'mapped' => false,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
        
            
            ->add('isVerified')

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    public function getDefaultOptions()
{
    return array(
        'roles' => null
    );
}


}
