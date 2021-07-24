<?php

namespace App\DataFixtures;

use App\Entity\Header;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HeaderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $description = new Header();
        $description->setTitle('Title');
        $description->setDescription('Description');

        $manager->persist($description);
        $manager->flush();
    }
}

