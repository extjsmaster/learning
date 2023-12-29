<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\Developer;
use App\classes\Department\Task;

class DeveloperTest extends TestCase
{
    /**
     * @var Developer.
     */
    protected $developer;

    public function setUp(): void
    {
        $this->developer = new Developer();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->developer);
        // parent:tearDown();
    }

    public function testDeleloper()
    {
        $this->assertCount(0, $this->developer->skills);
    }

    public function testCreate()
    {
        $developer = new Developer(['php', 'javascript']);
        $this->assertCount(2, $developer->skills);
        $this->assertFalse($developer->isBusy());
    }

    public function testAddSkill()
    {
        $this->developer->addSkill('php');
        $this->assertCount(1, $this->developer->skills);
    }

    public function testAddSkillAlreadyExists()
    {
        $this->developer->addSkill('php');
        $this->developer->addSkill('php');
        $this->assertCount(1, $this->developer->skills);
    }

    public function testHasSkill()
    {
        $this->developer->addSkill('php');
        $this->assertTrue($this->developer->hasSkill('php'));
        $this->assertFalse($this->developer->hasSkill('Laravel'));
    }

    public function testBeginTask()
    {
        $task = new Task('php');
        $this->assertEquals($task->status, 'new');
        $this->assertFalse($this->developer->isBusy());

        $this->developer->beginTask($task);
        $this->assertTrue($this->developer->isBusy());
        $this->assertEquals($task->status, 'work');

        $this->assertSame($task, $this->developer->getTask());
    }

    public function testCompleteTask()
    {
        $this->developer->completeTask();
        $this->assertNull($this->developer->getTask());
    }

    public function testBusy()
    {
        $task = new Task('php');
        $this->developer->beginTask($task);
        $this->assertTrue($this->developer->isBusy());
        $this->developer->completeTask();
        $this->assertFalse($this->developer->isBusy());
    }
}
