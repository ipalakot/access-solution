<?php

namespace App\Tests\entity;

use App\Entity\User;
use App\Entity\Utilisateur;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserUnitTest extends KernelTestCase
{

    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);

    }
    public function testUserValid(): void
    {

        $user = new User();


        $user->setFullName('fullName')
            ->setEmail('email')
            ->setPassword('$password')
            ->setPlainPassword('plainPassword');
        $this->assertTrue($user->getFullName() === 'fullName');
        $this->assertTrue($user->getEmail() === 'email');
        $this->assertTrue($user->getPlainPassword() === 'plainpassword');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getPlainPassword() === 'plainpassword');
    }

    public function testUserFalse(): void
    {

        $user = new User();

        $user->setFullName('fullName')
            ->setEmail('email')
            ->setPassword('password')
            ->setPlainPassword('plainpassword');
        $this->assertFalse($user->getFullName() !== 'fullName');
        $this->assertFalse($user->getEmail() !== 'email');
        $this->assertFalse($user->getPassword() !== 'password');
        $this->assertFalse($user->getPlainPassword() !== 'plainpassword');
    }

    public function testUserEmpty(): void
    {

        $user = new User();

        $this->assertEmpty($user->getFullName());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getPlainPassword());
        $this->assertEmpty($user->getId());
    }
    public function testAddremoveSetUtilisateur()
    {

        $user = new User();
        $utilisateur = new Utilisateur();

        $this->assertEmpty($user->getUtilisateurs());

        $user->addUtilisateur($utilisateur);
        $this->assertContains($utilisateur, $user->getUtilisateurs());

        $user->removeUtilisateur($utilisateur);
        $this->assertEmpty($user->getUtilisateurs());
    }
}
