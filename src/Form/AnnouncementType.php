<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Category;
use App\Entity\Enterprise;
use App\Entity\Certification;
use App\Entity\Specialization;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use PhpParser\Parser\Multiple;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('title', null, [
                'label' => false
            ])
            ->add('description', CKEditorType::class, [
                'label' => false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
            ])
            ->add('members', EntityType::class, [
                'class' => Member::class,
                'choice_label' => 'firstname',
                'multiple' => true,
                'disabled' => true
            ])
            ->add('specialization', EntityType::class, [
                'class' => Specialization::class,
                'label' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            // ->add('enterprise', EntityType::class,[
            //     'class'=>Enterprise::class,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
