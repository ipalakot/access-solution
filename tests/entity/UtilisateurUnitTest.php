<?php

namespace App\Tests;

use App\Entity\Utilisateur;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UtilisateurUnitTest extends KernelTestCase
{

    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);

    }
    public function testUtilisateurValid(): void
    {

        $utilisateur = new Utilisateur();



        $utilisateur->setFullName('fullName')
            ->setEmail('email')


            ->setPassword('$password')
            ->setDeliveryAddress('$DeliveryAddress')
            ->setZipCode('$ZipCode')
            ->setCity('$City')
            ->setPhoneNumber('$PhoneNumber')
            ->setPlainPassword('plainPassword');
        $this->assertTrue($utilisateur->getFullName() === 'fullName');
        $this->assertTrue($utilisateur->getEmail() === 'email');
        $this->assertTrue($utilisateur->getPlainPassword() === 'plainpassword');
        $this->assertTrue($utilisateur->getPassword() === 'password');
        $this->assertTrue($utilisateur->getPlainPassword() === 'plainpassword');
        $this->assertTrue($utilisateur->getZipCode() === 'zipCode');
        $this->assertTrue($utilisateur->getPhoneNumber() === 'phoneNumber');
        $this->assertTrue($utilisateur->getDeliveryAddress() === 'deliveryAddress');
    }

    public function testUtilisateurFalse(): void
    {

        $utilisateur = new Utilisateur();


        $utilisateur->setFullName('fullName')
            ->setEmail('email')
            ->setPassword('password')
            ->setPlainPassword('plainpassword')
            ->setDeliveryAddress('DeliveryAddress')
            ->setZipCode('ZipCode')
            ->setCity('City')
            ->setPhoneNumber('PhoneNumber');
        $this->assertFalse($utilisateur->getFullName() !== 'fullName');
        $this->assertFalse($utilisateur->getEmail() !== 'email');
        $this->assertFalse($utilisateur->getPassword() !== 'password');
        $this->assertFalse($utilisateur->getPlainPassword() !== 'plainpassword');
        $this->assertFalse($utilisateur->getZipCode() !== 'zipCode');
        $this->assertFalse($utilisateur->getPhoneNumber() !== 'phoneNumber');
        $this->assertFalse($utilisateur->getDeliveryAddress() !== 'deliveryAddress');
        $this->assertFalse($utilisateur->getCity() !== 'city');
    }

    public function testUtilisateurEmpty(): void
    {

        $utilisateur = new Utilisateur();

        $this->assertEmpty($utilisateur->getFullName());
        $this->assertEmpty($utilisateur->getEmail());
        $this->assertEmpty($utilisateur->getPassword());
        $this->assertEmpty($utilisateur->getPlainPassword());
        $this->assertEmpty($utilisateur->getZipCode());
        $this->assertEmpty($utilisateur->getPhoneNumber());
        $this->assertEmpty($utilisateur->getDeliveryAddress());
        $this->assertEmpty($utilisateur->getCity());
        $this->assertEmpty($utilisateur->getId());
    }
    public function testGetUser(): void
    {
        $user = new User();
        $utilisateur = new Utilisateur();

        $this->assertNull($utilisateur->getUser());

        $utilisateur->setUser($user);

        $this->assertSame($user, $utilisateur->getUser());
    }

    public function testSetUser(): void
    {
        $user1 = new User();
        $user2 = new User();
        $utilisateur = new Utilisateur();

        $result = $utilisateur->setUser($user1);

        $this->assertSame($utilisateur, $result);

        $this->assertSame($user1, $utilisateur->getUser());

        $utilisateur->setUser($user2);

        $this->assertSame($user2, $utilisateur->getUser());
    }
}
