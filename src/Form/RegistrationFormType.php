<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{

    public static function getSubscribedEvents(): array
    {
        // Tells the dispatcher that you want to listen on the form.PRE_SUBMIT
        // event and that the onPreSubmit method should be called.
        return [FormEvents::PRE_SUBMIT => 'onPreSubmit'];
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            ->add('membershipType', ChoiceType::class, [
                'mapped' => false,
                'choices'  => [
                    'Membre' => 'member',
                    'Entreprise' => 'enterprise',
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Choisissez votre type de compte',
            ])
            // De base il est pas en required 
            // TODO: Vérifier qu'il l'est bien pas
            ->add('userMember', MemberType::class, [
                'label' => false,
                'required' => false,
            ])

            ->add('userEnterprise', EnterpriseType::class, [
                'label' => false,
                'required' => false,
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])


            // ->add('roles')

        ;


        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'conditional']);
    }


    public function conditional(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        // Vérifier la valeur du radio
        // si 'est member on indique le champ userMember (ou plutôt le sous form) est requis.
        if ($user['membershipType'] === 'member') {
            $form->add('userMember', MemberType::class, [
                'label' => false,
                'required' => true,
            ]);
            unset($user['userEnterprise']);
            $event->setData($user);
        }

        // pareil pour entreprise

        if ($user['membershipType'] === 'enterprise') {
            $form->add('userEnterprise', EnterpriseType::class, [
                'label' => false,
                'required' => true,
            ]);
            unset($user['userMember']);
            $event->setData($user);
        }

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
