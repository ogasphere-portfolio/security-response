<?php

namespace App\Form\BackOffice;

use App\Entity\Member;
use App\Entity\Announcement;
use App\Entity\Specialization;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Prénom" ])
            ->add('lastname', TextType::class, [
                'label' => "Nom" ])
            /* ->add('slug') */
            ->add('description')
          //  ->add('picture')
            ->add('gender')
            ->add('city')
            ->add('job_status')
            ->add('announcements', EntityType::class, [
                'class' => Announcement::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'title',
                'label' => "Liste des annonces postulées"

              
            ])
            ->add('specialization', EntityType::class, [
                'class' => Specialization::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
                'label' => "Spécialisations"
              
            ])
            /*   ->add('created_at')
            ->add('updated_at')
            ->add('created_by')
            ->add('updated_by')
            ->add('announcements')
            ->add('social_network')
            
            ->add('user')
            ->add('document') */;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
