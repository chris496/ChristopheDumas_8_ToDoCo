<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const EMAIL = 'email@mail.fr';
    private const PASSWORD = 'password';
    private const USERNAME = 'name';

    public function testIfTrue(): void
    {
        $user = new User();

        $this->assertSame(null, $user->getId());
        
        $user->setEmail(self::EMAIL);
        $this->assertSame(self::EMAIL, $user->getEmail());

        $user->setPassword(self::PASSWORD);
        $this->assertSame(self::PASSWORD, $user->getPassword());

        $user->setUsername(self::USERNAME);
        $this->assertSame(self::USERNAME, $user->getUsername());
    }
}