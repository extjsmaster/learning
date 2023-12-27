<?php

namespace App\Tests\functional\classes\Learning\Department;

use DateInterval;
use App\Tests\TestCase;
use App\classes\Department\Developer;
use App\classes\Department\Task;

class TaskTest extends TestCase
{
    /**
     * @var Task
     */
    protected $task;

    public function setUp(): void
    {
        $this->task = new Task('developer');
        parent::setUp();
    }

    public function testCreate()
    {
        $this->assertEquals('developer', $this->task->skill);
        $this->assertTrue($this->task->isNew());
        $this->assertNull($this->task->getDeveloper());
    }

    public function testSetSkill()
    {
        $this->task->setSkill('javascript');
        $this->assertEquals('javascript', $this->task->skill);
    }

    public function testBegin()
    {
        $developer = new Developer();
        $this->assertNull($this->task->begined_at);
        $this->task->begin($developer);
        $this->assertTrue($this->task->inWork());
        $this->assertNotNull($this->task->begined_at);
        $this->assertEquals($developer, $this->task->getDeveloper());
        $this->task->complete();
        $this->task->begin($developer);
        $this->assertFalse($this->task->inWork());
    }

    public function testComplete()
    {
        $this->assertTrue($this->task->isNew());
        $this->task->complete();
        $this->assertFalse($this->task->isComplete());

        $developer = new Developer();
        $this->task->begin($developer);
        $this->assertNotNull($this->task->getDeveloper());

        $this->task->complete();
        $this->assertTrue($this->task->isComplete());
        $this->assertNull($this->task->getDeveloper());
        $this->assertNotNull($this->task->completed_at);
    }

    public function testIsReady()
    {
        $this->assertFalse($this->task->isReady());
        $developer = new Developer(['php']);
        $this->task->begin($developer);
        $this->assertFalse($this->task->isReady());
        $this->task->begined_at = $this->task->begined_at->sub(new DateInterval('P2D'));
        $this->assertTrue($this->task->isReady());
    }
}
