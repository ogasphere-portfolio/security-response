<?php

namespace App\Form;

use App\Entity\Certification;
use App\Entity\Member;
use App\Entity\Specialization;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')                        
            ->add('certification',EntityType::class,[
                'class' => Certification::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
            ])            
            ->add('specialization',EntityType::class,[
                'class' => Specialization::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
