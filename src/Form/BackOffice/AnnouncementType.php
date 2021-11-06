<?php

namespace App\Form\BackOffice;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slug')
            ->add('title')
            ->add('description')
            ->add('status')
        /*     ->add('created_at')
            ->add('updated_at')
            ->add('created_by')
            ->add('updated_by') */
            ->add('certification')
            ->add('members')
            ->add('specialization')
            ->add('document')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
