<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\EnterpriseProvider;
use App\Entity\Announcement;
use App\Entity\Enterprise;
use App\Entity\Member;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        $faker->addProvider(new EnterpriseProvider($faker));

        for($i = 0; $i <= 9; $i++) {
            $enterprise = new Enterprise();
            $enterprise->setBusinessName($faker->unique()->enterpriseTitle())
                        ->setSiretNumber($faker->siret())
                        ->setAddress($faker->streetAddress())
                        ->setCity($faker->city())
                        ->setZipCode($faker->postcode())
                        ->setCreatedAt(new \DateTimeImmutable());
                        
         $manager->persist($enterprise);

        }

        for($i = 0; $i <= 9; $i++) {
             $member = new Member();            
             $member->setFirstname($faker->firstName())
                        ->setLastname($faker->lastName())
                        ->setDescription($faker->text())
                        ->setPicture($faker->word())
                        ->setGender($faker->numberBetween(0, 1))
                        ->setCity($faker->city())
                        ->setJobStatus($faker->numberBetween(0, 1))
                        ->setCreatedAt(new \DateTimeImmutable());
          $manager->persist($member);

         }

        for($i = 0; $i <= 9; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
                 ->setPassword($faker->password())
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setIsVerified(true)  ;
         $manager->persist($user);

        }

        for($i = 0; $i <= 9; $i++) {
            $announcement = new Announcement();
            $announcement->setTitle($faker->sentence())
                            ->setDescription($faker->paragraphs(2, true))
                            ->setStatus($faker->numberBetween(0, 1))
                            ->setCreatedAt(new \DateTimeImmutable());
                        
         $manager->persist($announcement);

        }
             

        $manager->flush();
    }
}

