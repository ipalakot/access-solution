<?php

namespace App\Tests\entity;

use App\Entity\Product;
use App\Entity\Category;

use App\Entity\Image;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductUnitTest extends KernelTestCase {

    public function testSomething(): void {
        $kernel = self::bootKernel();

        $this->assertSame( 'test', $kernel->getEnvironment() );
        // $routerService = static::getContainer()->get( 'router' );
        // $myCustomService = static::getContainer()->get( CustomService::class );

    }

    public function testProductValid(): void {

        $product = new Product();
        $category = new Category();

        $product->setTitle( 'title' )

        ->setDescription( 'Description' )
        ->setBrand( 'brand' )
        ->setPrice( '1000' )
        ->setCreatedAt( new \DateTimeImmutable() )
        ->setUpdatedAt( new \DateTimeImmutable() )
        ->setCategoryShop( $category );

        $this->assertTrue( $product->getTitle() === 'title' );
        // Adjusted assertion
        $this->assertTrue( $product->getDescription() === 'Description' );

        $this->assertTrue( $product->getBrand() === 'brand' );

        $this->assertFalse( $product->getPrice() === 'price' );

        $this->assertTrue( $product->getCreatedAt() instanceof \DateTimeImmutable );

        $this->assertTrue( $product->getUpdatedAt() instanceof \DateTimeImmutable );

        $this->assertTrue( $product->getCategoryShop() === $category );

    }

    public function testAddImageShop() {
        $product = new Product();
        $image = new Image();

        $this->assertEmpty( $product->getImageShop() );

        $product->addImageShop( $image );
        $this->assertContains( $image, $product->getImageShop() );

        $product->RemoveImageShop( $image );
        $this->assertEmpty( $product->getImageShop() );

    }

}

