<?php

/*
 * This file is part of the Symfony package.
 * (c) Fabien Potencier <fabien@symfony.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // $tasks = ['Iphone 13', 'Samsung S22', 'Oppo find x5', 'Google pixel 6', 'Xiaomi Mi 11', 'Honor Magic 4', 'Sony Xperia 1'];

        // Création d'un user
        $user = new User();
        $user->setEmail('admin@todoco.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setUsername($faker->Name());
        // $user->setCreatedAt(new DateTimeImmutable());
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@todoco.com');
        $user->setRoles(['ROLE_USER']);
        $user->setUsername($faker->Name());
        // $user->setCreatedAt(new DateTimeImmutable());
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('anonyme@todoco.com');
        $user->setRoles([]);
        $user->setUsername('anonyme');
        // $user->setCreatedAt(new DateTimeImmutable());
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
        $manager->persist($user);

        // create user
        for ($i = 0; $i < 5; ++$i) {
            $user = new User();
            // $user->setCreatedAt(new DateTimeImmutable())
            $user->setEmail($faker->safeEmail)
            ->setRoles(['ROLE_user'])
            ->setUsername($faker->Name());

            $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
            $manager->persist($user);
        }

        // create task
        for ($i = 0; $i < 5; ++$i) {
            $task = new Task();
            $task
                ->setContent('description nouvelle tâche')
                ->setTitle('nouvelle tâche')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setUser($user);

            $manager->persist($task);
        }

        $manager->flush();
    }
}
