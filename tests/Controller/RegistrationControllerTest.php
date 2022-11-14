<?php

/*
 * This file is part of the Symfony package.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegistrationControllerTest extends WebTestCase
{
    public function testListAction(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/users');
        $this->assertResponseIsSuccessful();
        // $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testRegister(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/users/create');

        $this->assertResponseIsSuccessful();
        // $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testEditAction(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/users/1/edit');
        $this->assertResponseIsSuccessful();
        // $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
