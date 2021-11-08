<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Certification;
use App\Entity\Enterprise;
use App\Entity\Member;
use App\Entity\Specialization;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class AnnouncementType extends AbstractType
{
    private $security;

    public function __construct(Security $security)    
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var User
         */

        $enterprise = $this->security->getUser();
        $nameEnterprise = $enterprise->getUserEnterprise()->getBusinessName();

       // dd($enterprise);
      

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
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class])
            ->add('enterprise', EntityType::class,[
                'class' => Enterprise::class, 
                'data_class' => Enterprise::class
            ]);            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
