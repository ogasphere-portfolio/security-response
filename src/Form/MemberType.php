<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class MemberType extends AbstractType
{

    

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('gender', ChoiceType::class, [
            'choices'  => [
                'Monsieur' => 1,
                'Madame' => 2,
                
                //'No' => false,
            ],
            'expanded' => true,
            'multiple' => false,
            'label' => false,
            'label_attr' =>[
                'class' => 'radio-inline'
            ]
            ])
            ->add('firstname', null, [
                "label" => "Prénom *",
            ])
            ->add('lastname', null, [
                "label" => "Nom de famille *",
            ])
            // ->add('slug')
            ->add('description')
            // ->add('picture')
            ->add('city',null, [
                'label' => 'Ville *'
            ])
            // ->add('job_status', ChoiceType::class, [
            //     "label" => "Statut profession *",
            //     'choices'  => [
            //         'En poste' => 1,
            //         'Recherche' => 2,
            //         //'No' => false,
            //     ],
            //     'expanded' => false,
            //     'multiple' => false,
            //     ])
            //     ->add('picture')
            //->add('created_at')
            // ->add('updated_at')
            // ->add('created_by')
            // ->add('updated_by')
            // ->add('announcements')
            // ->add('social_network')
            //->add('specialization')
            //->add('document')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
