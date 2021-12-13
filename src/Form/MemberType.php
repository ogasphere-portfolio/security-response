<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Specialization;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class MemberType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if (isset($options['type']) && $options['type'] === 'specialization') {
            $builder->add('specialization',  EntityType::class, [
                'class' => Specialization::class,
                'multiple' => true,
                'expanded' => true,
                'label' => ' '
            ])
                ->add('save', SubmitType::class, [
                    'attr' => ['class' => 'btn btn-primary my-5'],
                    'label' => 'Modifier mes spécialisations'
                ]);
        } else {
            $builder
                ->add('gender', ChoiceType::class, [
                    'choices'  => [
                        'Monsieur' => 1,
                        'Madame' => 2,
                        //'No' => false,
                    ],
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => false,
                    'label_attr' => [
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
                ->add('description', null, [
                    'label' => 'description *'
                ])
                // ->add('picture')
                ->add('city', null, [
                    'label' => 'Ville *'
                ])
                ->add('job_status', ChoiceType::class, [
                    "label" => "Statut profession *",
                    'choices'  => [
                        'En poste' => 1,
                        'Recherche' => 2,
                        //'No' => false,
                    ],
                    'expanded' => false,
                    'multiple' => false,
                ]);
        }

        // Additionals fields, pick one if needed
        // ->add('picture')
        //->add('created_at')
        // ->add('updated_at')
        // ->add('created_by')
        // ->add('updated_by')
        // ->add('announcements')
        // ->add('social_network')
        //->add('specialization')
        //->add('document')

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
            'type' => 'default'
        ]);
    }
}
