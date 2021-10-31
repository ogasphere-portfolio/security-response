<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\EnterpriseProvider;
use App\Entity\Announcement;
use App\Entity\Category;
use App\Entity\Certification;
use App\Entity\Enterprise;
use App\Entity\Member;
use App\Entity\Specialization;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        $faker->addProvider(new EnterpriseProvider($faker));

        
        $userList = [];
        for ($i = 0; $i <= 9; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
                ->setPassword($faker->password())
                ->setRoles([$faker->word()])
                ->setCreatedAt(new \DateTimeImmutable())
                ->setIsVerified(true);
            $manager->persist($user);

            $userList[] = $user;
        }

        $memberList = [];
        for ($i = 0; $i <= 9; $i++) {
            $member = new Member();
            $member->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setDescription($faker->text())
                ->setPicture($faker->word())
                ->setGender($faker->numberBetween(0, 1))
                ->setCity($faker->city())
                ->setUser($userList[$i])
                ->setJobStatus($faker->numberBetween(0, 1))
                ->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($member);

            $memberList[] = $member;
        }
        
        //$enterpriseList = [];
        for ($i = 0; $i <= 9; $i++) {
            $enterprise = new Enterprise();
            $enterprise->setBusinessName($faker->unique()->enterpriseTitle())
                ->setSiretNumber($faker->siret())
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setUser($userList[$i])
                ->setSlug(strtolower($this->slugger->slug($enterprise->getBusinessName())))
                ->setZipCode($faker->postcode())
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($enterprise);

            //$enterpriseList[] = $enterprise;
        }

        $specializationList = [];
        for ($i = 0; $i <= 9; $i++) {
            $specialization = new Specialization();
            $specialization->setName($faker->word())
                          ->setSlug((strtolower($this->slugger->slug($specialization->getName()))))
                          ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($specialization);

            $specializationList[] = $specialization;
        }

        $certificationList = [];
        for ($i = 0; $i <= 9; $i++) {
            $certification = new Certification();
            $certification->setName($faker->word())
                          ->setSlug((strtolower($this->slugger->slug($certification->getName()))))
                          ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($certification);

            $certificationList[] = $certification;
        }


        $announcementList = [];
        for ($i = 0; $i <= 9; $i++) {
            $announcement = new Announcement();
            $announcement->setTitle($faker->sentence())
                ->setDescription($faker->paragraphs(2, true))
                ->setStatus($faker->numberBetween(0, 1))
                ->addMember($memberList[$i])
                ->addSpecialization($specializationList[$i])
                //->addCategory($categoryList[])
                ->addCertification($certificationList[$i])
                ->setSlug((strtolower($this->slugger->slug($announcement->getTitle()))))
                ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($announcement);

            $announcementList[] = $announcement;
        }

        $categoryList = [];
        for ($i = 0; $i <= 9; $i++) {
            $category = new Category();
            $category->setName($faker->word())
                     ->setAnnouncement($announcementList[$i])
                     ->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($category);

            $categoryList[] = $category;
        }

       


        
        

       

        $manager->flush();
    }



}
