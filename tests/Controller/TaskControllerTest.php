<?php

/*
 * This file is part of the Symfony package.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends WebTestCase
{
    //private KernelBrowser|null $client = null;

    public function testListActionRedirect(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $client->request('GET', '/task');
        $this->assertResponseIsSuccessful();
    }

    public function testCreateActionRedirect()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'title';
        $form['task[content]'] = 'content';
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testEditActionRedirect()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/tasks/1/edit');
        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'title';
        $form['task[content]'] = 'content';
        $client->submit($form);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testToggleTaskActionRedirect()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks/1/toggle');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    public function testDeleteActionRedirect()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@todoco.com');
        $client->loginUser($testUser);
        $client->request('GET', '/tasks/2/delete');
        $this->assertResponseRedirects('/task', Response::HTTP_FOUND);
    }
}
