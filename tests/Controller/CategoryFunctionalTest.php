<?php

namespace App\Tests\Controller;

use App\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CategoryFunctionalTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/category');
        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('h1', 'Hello World');
    }






}
