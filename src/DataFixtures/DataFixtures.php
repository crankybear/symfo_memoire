<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");

        for($i = 0; $i < 5; $i++) {
            $category = new Category();

            $category
                ->setTitle($faker->word)
                ->setDescription($faker->catchphrase());

            $manager->persist($category);

            for($j = 0; $j <10; $j++) {
                $product = new Product();

                $product
                    ->setCategory($category)
                    ->setName($faker->word)
                    ->setDescription($faker->catchphrase())
                    ->setImage($faker->imageUrl())
                    ->setPrice($faker->randomFloat(2, 9, 1000));

                $manager->persist($product);
            }

        }

        $manager->flush();
    }
}
