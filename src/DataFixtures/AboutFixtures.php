<?php

namespace App\DataFixtures;

use App\Entity\About;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AboutFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $about = new About();
        $about->setTitle("Une courte introduction sur moi");
        $about->setDescription("Je m'appel Cédric badjah, je suis développeur web en freelance sous le nom de Samakunchan Technology.");
        $manager->persist($about);

        $manager->flush();
    }
}
