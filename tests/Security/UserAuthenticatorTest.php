<?php

namespace App\Tests\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserAuthenticatorTest extends WebTestCase
{
    public function testAuth(): void
    {
        $urlGenerator = $this->client->getContainer()->get('router.default');

        $this->client->request(Request::METHOD_GET, $urlGenerator->generate('homepage'));
    
    }
}
