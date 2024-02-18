<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Génération de 10 catégories
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();

            $category->setTitle($faker->sentence(2))
                ->setDescription($faker->sentence(4));

            $manager->persist($category);

            // Génération de 6 articles par catégorie
            for ($j = 0; $j < 6; $j++) {
                $product = new Product();

                $product->setTitle($faker->word(5))
                    ->setDescription($faker->sentence(4))
                    ->setBrand($faker->sentence(1))
                    ->setPrice($faker->randomDigit())
                    ->setCategoryShop($category);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
