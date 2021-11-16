<?php

namespace App\Form;

use App\Entity\Specialization;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecializationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            // ->add('slug')
            // ->add('created_at')
            // ->add('updated_at')
            // ->add('created_by')
            // ->add('updated_by')
            // ->add('announcements')
            // ->add('members')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Specialization::class,
        ]);
    }
}
