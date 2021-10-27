<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\EnterpriseProvider;
use App\Entity\Enterprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        $faker->addProvider(new EnterpriseProvider($faker));

        for($i = 1; $i <= 10; $i++) {
            $enterprise = new Enterprise();
            $enterprise->setBusinessName($faker->unique()->enterpriseTitle())
                        ->setSiretNumber($faker->siret())
                        ->setAddress($faker->streetAddress())
                        ->setCity($faker->city())
                        ->setZipCode($faker->postcode())
                        ->setCreatedAt(new \DateTimeImmutable());
                        
         $manager->persist($enterprise);

        }

        $manager->flush();
    }
}
