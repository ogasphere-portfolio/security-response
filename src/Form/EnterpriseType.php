<?php

namespace App\Form;

use App\Entity\Enterprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnterpriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('slug')
            ->add('business_name',null, [
                "label" => "Nom de l'entreprise *",
            ])
            ->add('siret_number',null, [
                'label'=> 'Numéro de Siret *'
            ])
            ->add('address')

            ->add('address_more')

            ->add('zip_code',null, [
                'label'=> 'Code postal *'
            ])
            ->add('city',null, [
                'label'=>'Ville *'
            ])
            ->add('phone_number',null, [
                'label'=> 'Numéro de téléphone'
            ])
            ->add('logo')
            ->add('latitude')
            ->add('longitude')
            ->add('contact_mail',null, [
                'label'=> 'Mail de contact'
            ])
            // ->add('created_at')
            // ->add('updated_at')
            // ->add('created_by')
            // ->add('updated_by')
            //->add('certification')
            //->add('user')
            // ->add('documents')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enterprise::class,
        ]);
    }
}
