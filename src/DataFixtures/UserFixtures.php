<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $password = password_hash('admin123', PASSWORD_DEFAULT);

        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setRoles($user->getRoles());
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
