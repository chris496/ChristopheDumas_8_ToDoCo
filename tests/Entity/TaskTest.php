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

        $this->assertSame(null, $task->getId());
        
        $task->setCreatedAt($date);
        $this->assertSame($date, $task->getCreatedAt());
        
        $task->setTitle(self::TITLE);
        $this->assertSame(self::TITLE, $task->getTitle());

        $task->setContent(self::CONTENT);
        $this->assertSame(self::CONTENT, $task->getContent());
        
        $task->setIsDone(true);
        $this->assertNotFalse(true, $task->isIsDone());

        $task->setUser($user);
        $this->assertSame($user, $task->getUser());

        
    }
}
