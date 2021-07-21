<?php

namespace App\DataFixtures;

use App\Entity\HomeBlock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BlockFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $blockName = [
            'first',
            'second',
            'third'
        ];

        $imageTitle = [
            'That\'s first image.',
            'That\'s second image.',
            'That\'s third image.'
        ];

        $textTitle = [
            'That\'s first block title.',
            'That\'s second block title.',
            'That\'s third block title.'
        ];

        $textValue = [
            'That\'s first block value.',
            'That\'s second block value.',
            'That\'s third block value.'
        ];

        for ($i = 0; $i < 3; $i++) {
            $block = new HomeBlock();
            $block->setBlockName($blockName[$i]);
            $block->setImageTitle($imageTitle[$i]);
            $block->setTextTitle($textTitle[$i]);
            $block->setTextValue($textValue[$i]);

            $manager->persist($block);
        }

        $manager->flush();
    }
}

