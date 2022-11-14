<?php

/*
 * This file is part of the Symfony package.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private const EMAIL = 'email@mail.fr';
    private const PASSWORD = 'password';
    private const USERNAME = 'name';
    private const ROLES = ['ROLE_USER'];

    public function testIfTrue(): void
    {
        $user = new User();
        $user->setEmail(self::EMAIL);
        $user->setEmail(self::EMAIL);
        $user->setPassword(self::PASSWORD);
        $user->setUsername(self::USERNAME);
        $user->setRoles(self::ROLES);

        $this->assertNull($user->getId());
        $this->assertSame(self::EMAIL, $user->getEmail());
        $this->assertSame(self::EMAIL, $user->getUserIdentifier());
        $this->assertSame(self::PASSWORD, $user->getPassword());
        $this->assertSame(self::USERNAME, $user->getUsername());
        $this->assertSame(self::ROLES, $user->getRoles());
    }
}
