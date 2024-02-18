<?php

namespace App\DataFixtures;

use App\Entity\Category;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

use Faker;
use Faker\Factory;



/** 
 * @codeCoverageIgnore
 * 
 */

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();

            $category->setTitle($faker->sentence(3))
                ->setDescription($faker->sentence(11));

            $manager->persist($category);
        }

        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ['group2'];
    }
}
