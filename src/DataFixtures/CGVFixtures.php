<?php

namespace App\DataFixtures;

use App\Entity\CGV;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CGVFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cgv = new CGV();
        $cgv->setTitle("Conditions générales de vente")
            ->setContent("Mes conditions ect...");

        $manager->persist($cgv);
        $manager->flush();
    }
}
