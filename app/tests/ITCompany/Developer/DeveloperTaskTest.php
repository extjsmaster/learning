<?php

namespace App\Tests\ITCompany\Developer;

use App\Tests\TestCase;
use App\classes\ITCompany\Developer;
use App\classes\ITCompany\Task;

class DeveloperTaskTest extends DeveloperTest
{
    /**
     * @var Developer.
     */
    protected $developer;

    /**
     * @var Task
     */
    protected $task;

    public function setUp(): void
    {
        parent::setUp();
        $this->task = new Task('php');
        $this->developer->beginTask($this->task);
    }

    protected function tearDown(): void
    {
        unset($this->developer);
        unset($this->task);
        // parent:tearDown();
    }

    public function testNewIsNotBusy()
    {
        $developer = new Developer();
        $this->assertFalse($developer->isBusy());
    }

    public function testBindTaskAfterBegin()
    {
        $this->assertSame($this->task, $this->developer->getTask());
    }

    public function testBindTaskAfterComplete()
    {
        $this->developer->completeTask();
        $this->assertNull($this->developer->getTask());
    }

    public function testBusyAfterBeginTask()
    {
        $this->assertTrue($this->developer->isBusy());
    }
    public function testBusyAfterCompleteTask()
    {
        $this->developer->completeTask();
        $this->assertFalse($this->developer->isBusy());
    }
}
