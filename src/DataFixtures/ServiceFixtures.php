<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $service = new Service();
        $service->setTitle("Cross platform")
            ->setDescription("Création d'application visible sur toute les plateformes");

        $manager->persist($service);

        $manager->flush();
    }
}
