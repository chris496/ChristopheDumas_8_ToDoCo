<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use Monolog\DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    private const TITLE = 'title';
    private const CONTENT = 'content';

    public function testIfTrue(): void
    {
        $date = new DateTimeImmutable('2022-11-01 17:07:00');
        $user = new User();
        $task = new Task();

        $task->setCreatedAt($date);
        $task->setTitle(self::TITLE);
        $task->setContent(self::CONTENT);
        $task->setIsDone(true);
        $task->setUser($user);

        $this->assertSame(null, $task->getId());
        $this->assertSame($date, $task->getCreatedAt());
        $this->assertSame(self::TITLE, $task->getTitle());
        $this->assertSame(self::CONTENT, $task->getContent());
        $this->assertNotFalse(true, $task->isIsDone());
        $this->assertSame($user, $task->getUser());
    }
}
