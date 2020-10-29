<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $client = new Client();
        $client->setCompany("NesWeb")
            ->setEmail("user@nesweb.fr")
            ->setRoles(['ROLE' => 'ROLE_USER']);
        $hash = password_hash('password', PASSWORD_BCRYPT);
        $client->setPassword($hash);
        $manager->persist($client);
        $this->addReference('client1', $client);

        $manager->flush();
    }
}
