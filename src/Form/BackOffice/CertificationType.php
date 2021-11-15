<?php

namespace App\Form\BackOffice;

use App\Entity\Certification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CertificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
           /*  ->add('slug')
            ->add('created_at')
            ->add('updated_at')
            ->add('created_by')
            ->add('updated_by') */
           /*  ->add('enterprises')
            ->add('announcements') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Certification::class,
        ]);
    }
}
