<?php

namespace App\Test\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilisateurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/utilisateur/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Utilisateur::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Utilisateur index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'utilisateur[fullName]' => 'Testing',
            'utilisateur[email]' => 'Testing',
            'utilisateur[pasword]' => 'Testing',
            'utilisateur[deliveryAddress]' => 'Testing',
            'utilisateur[zipCode]' => 'Testing',
            'utilisateur[city]' => 'Testing',
            'utilisateur[phoneNumber]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Utilisateur();
        $fixture->setFullName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setPasword('My Title');
        $fixture->setDeliveryAddress('My Title');
        $fixture->setZipCode('My Title');
        $fixture->setCity('My Title');
        $fixture->setPhoneNumber('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Utilisateur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Utilisateur();
        $fixture->setFullName('Value');
        $fixture->setEmail('Value');
        $fixture->setPasword('Value');
        $fixture->setDeliveryAddress('Value');
        $fixture->setZipCode('Value');
        $fixture->setCity('Value');
        $fixture->setPhoneNumber('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'utilisateur[fullName]' => 'Something New',
            'utilisateur[email]' => 'Something New',
            'utilisateur[pasword]' => 'Something New',
            'utilisateur[deliveryAddress]' => 'Something New',
            'utilisateur[zipCode]' => 'Something New',
            'utilisateur[city]' => 'Something New',
            'utilisateur[phoneNumber]' => 'Something New',
        ]);

        self::assertResponseRedirects('/utilisateur/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFullName());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getPasword());
        self::assertSame('Something New', $fixture[0]->getDeliveryAddress());
        self::assertSame('Something New', $fixture[0]->getZipCode());
        self::assertSame('Something New', $fixture[0]->getCity());
        self::assertSame('Something New', $fixture[0]->getPhoneNumber());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Utilisateur();
        $fixture->setFullName('Value');
        $fixture->setEmail('Value');
        $fixture->setPasword('Value');
        $fixture->setDeliveryAddress('Value');
        $fixture->setZipCode('Value');
        $fixture->setCity('Value');
        $fixture->setPhoneNumber('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/utilisateur/');
        self::assertSame(0, $this->repository->count([]));
    }
}
