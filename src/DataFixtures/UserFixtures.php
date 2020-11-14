<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bobby = new User();
        $bobby
            ->setEmail('bobby@bobby.com')
            ->setPassword(password_hash('bobby', PASSWORD_DEFAULT ))
            ->setUsername('bobby');

        $manager->persist($bobby);

        $francis = new User();
        $francis
            ->setEmail('francis@francis.fr')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword(password_hash('francis', PASSWORD_DEFAULT))
            ->setUsername('francis');

        $manager->persist($francis);

        $manager->flush();
    }
}
