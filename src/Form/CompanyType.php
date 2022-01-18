<?php

namespace App\Form;

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
                "label" => "Nom de la société",
                'required' => true
            ])
            
            ->add('address',null, [
                'label'=> 'Adresse',
                'required' => true
            ])

            ->add('address_more',null, [
                'label'=> 'Adresse complémentaire'
            ])

            ->add('zip_code',null, [
                'label'=> 'Code postal',
                'required' => true
            ])
            ->add('city',null, [
                'label'=>'Ville',
                'required' => true
            ])
            ->add('phone_number',null, [
                'label'=> 'Numéro de téléphone'
            ])
            // ->add('logo')
       
            ->add('contact_mail',null, [
                'label'=> 'Mail de contact',
                'required' => true
            ]);
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
