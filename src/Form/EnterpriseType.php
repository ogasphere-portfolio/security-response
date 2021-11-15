<?php

namespace App\Form;

use App\Entity\Enterprise;
use App\Entity\Certification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnterpriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        if(isset($options['type']) && $options['type'] === 'certification') {
            $builder->add('certification',  EntityType::class, [
                'class' => Certification::class,
                'multiple' => true,
                'expanded' => true,
                'label' => ' '
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary my-5'],
                'label' => 'Modifier mes certifications'
            ]);
        }else {
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
            /*  // ->add('latitude',null,[
                    'attr' => ['class' => 'tinymce, hide-coordinates'],
                ])
                //->add('longitude', null, [
                    'attr' => ['class' => 'hide-coordinates']
                ]) */
                ->add('contact_mail',null, [
                    'label'=> 'Mail de contact'
                ]);

        }
            // Additionals fields, pick one if needed
            // ->add('created_at')
            // ->add('updated_at')
            // ->add('created_by')
            // ->add('updated_by')
            /* ->add('certification')
            ->add('user')
            ->add('documents')
            ->add('announcement') */
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Enterprise::class,
            'type' => 'default'
        ]);
    }
}
