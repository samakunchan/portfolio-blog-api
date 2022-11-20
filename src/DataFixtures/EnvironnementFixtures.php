<?php

namespace App\DataFixtures;

use App\Entity\Environnement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnvironnementFixtures extends Fixture
{
    public const ENV_REFERENCE = 'ENV';

    public function load(ObjectManager $manager): void
    {
         $environnementList = ["Email", "Blog", "Portfolio", "Todo"];
         foreach ($environnementList as $item){
             $environnement = new Environnement();
             $environnement->setTitle($item);
             $manager->persist($environnement);
             $this->addReference(self::ENV_REFERENCE.$item, $environnement);
         }
        $manager->flush();
    }
}
