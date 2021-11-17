<?php

namespace App\Form\BackOffice;

use App\Entity\Member;
use App\Entity\Category;
use App\Entity\Enterprise;
use App\Entity\Specialization;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
       
       // dd($enterprise);
      

        $builder
            ->add('title')
            ->add('description', CKEditorType::class)
            ->add('status',ChoiceType::class, [
                'choices'  => [
                    'Non validé' => 0,
                    'Validé' => 1,
                ]])                    
            ->add('category', EntityType::class,[
                'class' => Category::class])  
            ->add('members', EntityType::class,[
                'class' => Member::class,
                'choice_label' => 'firstname',
                'multiple' => true,
                'expanded' => true,
                'disabled' =>false])
            ->add('specialization', EntityType::class,[
                'class' => Specialization::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'disabled' =>false])      
            ;                             
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
