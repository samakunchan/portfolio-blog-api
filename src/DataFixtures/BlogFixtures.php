<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BlogFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $portfolio = new Blog();
        $portfolio->setTitle("Comlink")
            ->setContent("Application Web de gestion de mandat de bien immobilier")
            ->setView(0)
            ->setStatus(false)
            ->setCategory($this->getReference(CategoriesFixtures::CAT_BLOG));

        $manager->persist($portfolio);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoriesFixtures::class];
    }
}
