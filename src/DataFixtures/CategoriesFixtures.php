<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture implements DependentFixtureInterface
{
    public const CAT_EMAIL = 'Email';
    public const CAT_BLOG = 'Blog';
    public const CAT_PORTFOLIO = 'Portfolio';

    public function load(ObjectManager $manager): void
    {
        $categoryPortfolio = new Category();
        $categoryPortfolio->setTitle("Angular");
        $categoryPortfolio->setDescription("Framework front end consacré à la construction d'application web.");
        $categoryPortfolio->setEnvironnement($this->getReference(EnvironnementFixtures::ENV_REFERENCE."Portfolio"));
        $manager->persist($categoryPortfolio);
        $this->addReference(self::CAT_PORTFOLIO, $categoryPortfolio);
        $manager->flush();

        $categoryEmail = new Category();
        $categoryEmail->setTitle("Demande d'information");
        $categoryEmail->setDescription("Demande d'information sur les services que je propose.");
        $categoryEmail->setEnvironnement($this->getReference(EnvironnementFixtures::ENV_REFERENCE."Email"));
        $manager->persist($categoryEmail);
        $this->addReference(self::CAT_EMAIL, $categoryEmail);
        $manager->flush();

        $categoryBlog = new Category();
        $categoryBlog->setTitle("Outils");
        $categoryBlog->setDescription("Logiciel, extension, IDE");
        $categoryBlog->setEnvironnement($this->getReference(EnvironnementFixtures::ENV_REFERENCE."Blog"));
        $manager->persist($categoryBlog);
        $this->addReference(self::CAT_BLOG, $categoryBlog);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EnvironnementFixtures::class];
    }
}
