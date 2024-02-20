<?php

namespace App\Tests\Controller;

use App\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProductFunctionalTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/product');
        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('h1', 'Hello World');
    }





}


