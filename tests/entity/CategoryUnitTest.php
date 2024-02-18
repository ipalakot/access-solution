<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryUnitTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);

    }

    public function testCategoryValid(): void
    {

        $category = new Category();


        $category->setTitle('title')
            ->setDescription('description');


        $this->assertTrue($category->getTitle() === 'title');
        $this->assertTrue($category->getDescription() === 'description');
    }

    public function testCategoryFalse(): void
    {
        $category = new Category();


        $category->setTitle('title')
            ->setDescription('description');

        $this->assertFalse($category->gettitle() !== 'title');
        $this->assertFalse($category->getDescription() !== 'description');
    }

    public function testCategoryVide(): void
    {
        $category = new Category();
        $this->assertEmpty($category->getTitle());
        $this->assertEmpty($category->getDescription());
        $this->assertEmpty($category->getId());
    }
    public function testAddremoveSertProduct()
    {
        $category = new Category();
        $product  = new Product();

        $this->assertEmpty($category->getProducts());
        $category->addProduct($product);
        $this->assertContains($product, $category->getProducts());

        $category->removeProduct($product);
        $this->assertEmpty($category->getProducts());
    }
}
