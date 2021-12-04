<?php

namespace App\Form\BackOffice;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('slug')
            ->add('business_name',null, [
                "label" => "Nom de la société *",
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
       
            ->add('contact_mail',null, [
                'label'=> 'Mail de contact'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
