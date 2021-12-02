<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\Form\FormExtension\RepeatedPasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


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
            ->add('username', null, [
                'label' => 'Nom d\'utilisateur *'
            ])
            ->add('email', null, [
                'label' => 'Adresse email *',
                'required' => true,
            ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])

            ->add('password', RepeatedPasswordType::class)
            // ->add('membershipType', ChoiceType::class, [
            //     'mapped' => false,
            //     'choices'  => [
            //         'Membre' => 'member',
            //         'Entreprise' => 'enterprise',
            //     ],
            //     'expanded' => true,
            //     'multiple' => false,
            //     'label' => 'Choisissez votre type de compte',
            // ])
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
            ->add('userCompany', CompanyType::class, [
                'label' => false,
                'required' => false,
            ])


            // ->add('roles', HiddenType::class)

        ;


        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'conditional']);
    }


    public function conditional(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();
        
        if (!empty($user['userEnterprise']['business_name'])) {
            $form->add('userEnterprise', EnterpriseType::class, [
                'label' => false,
                'required' => true,
            ]);
            unset($user['userMember']);
            unset($user['userCompany']);
            $event->setData($user);
        }
        if (!empty($user['userMember']['firstname'])){
            $form->add('userMember', MemberType::class, [
                'label' => false,
                'required' => true,
            ]);

            unset($user['userEnterprise']);
            unset($user['userCompany']);
            $event->setData($user);
        }
        if (!empty($user['userCompany']['business_name'])) {
            $form->add('userCompany', CompanyType::class, [
                'label' => false,
                'required' => true,
            ]);
            unset($user['userMember']);
            unset($user['userEnterprise']);
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
