<?php

namespace App\DataFixtures;

use App\Entity\Portfolio;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PortfolioFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $portfolio = new Portfolio();
        $portfolio->setTitle("Emplacement numero 1")
            ->setDescription("Application Web de gestion de mandat de bien immobilier")
            ->setCategory($this->getReference(CategoriesFixtures::CAT_PORTFOLIO));

        $manager->persist($portfolio);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoriesFixtures::class];
    }
}
