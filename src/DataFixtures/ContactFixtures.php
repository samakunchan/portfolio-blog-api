<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact->setName("Jean Petit")
            ->setEmail("jean-petit@test.com")
            ->setMessage("Ceci est un message test")
            ->setReaded(false)
            ->setCategory($this->getReference(CategoriesFixtures::CAT_EMAIL));

        $manager->persist($contact);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoriesFixtures::class];
    }
}
