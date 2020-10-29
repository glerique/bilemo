<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{

    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $product->setModel($faker->randomElement(['iPhone', 'Samsung', 'OnePlus']) . ' ' . rand(18, 22))
                ->setDescription('Ce smartphone est un monstre de technologie. Il ravira les amateurs de puissance et de grands écrans.')
                ->setColor($faker->randomElement(['noir', 'gris', 'bleu']))
                ->setScreensize($faker->randomElement(['6.1', '6.7', '7']))
                ->setStorage($faker->randomElement(['64', '128', '256']))
                ->setPrice(rand(900, 1200))
                ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                ->addClient($this->getReference('client1'));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
