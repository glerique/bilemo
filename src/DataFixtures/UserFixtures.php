<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($u = 0; $u < 10; $u++) {


            for ($u = 0; $u < 20; $u++) {
                $user = new User();
                $user->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setAddress($faker->streetAddress)
                    ->setPostCode(rand(11900, 95200))
                    ->setCity($faker->city)
                    ->setEmail($faker->email)
                    ->setClient($this->getReference('client1'));

                $manager->persist($user);
            }
        }

        $manager->flush();
    }
}
