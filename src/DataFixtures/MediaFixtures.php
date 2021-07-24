<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $media = new Media();
        $media->setFacebook('');
        $media->setTwitter('');
        $media->setInstagram('');

        $manager->persist($media);
        $manager->flush();
    }
}

