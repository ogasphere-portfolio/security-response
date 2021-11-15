<?php

namespace App\Form\BackOffice;

use App\Entity\Enterprise;
use App\Entity\Announcement;
use App\Entity\Certification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnterpriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slug')
            ->add('business_name')
            ->add('siret_number')
            ->add('address')
            ->add('address_more')
            ->add('zip_code')
            ->add('phone_number')
            ->add('logo')
            ->add('latitude')
            ->add('longitude')
            ->add('contact_mail')
            ->add('city')
            // ->add('created_at')
            // ->add('updated_at')
            // ->add('created_by')
            // ->add('updated_by')
            ->add('certification', EntityType::class, [
                'class' => Certification::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
              
            ])
            //->add('user')
            //->add('documents')
            ->add('announcement', EntityType::class, [
                'class' => Announcement::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'title',
              
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enterprise::class,
        ]);
    }
}
