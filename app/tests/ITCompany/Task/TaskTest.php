<?php

namespace App\Tests\ITCompany\Task;

use App\Tests\TestCase;
use App\classes\ITCompany\Developer;
use App\classes\ITCompany\Task;

abstract class TaskTest extends TestCase
{
    /**
     * @var Task
     */
    protected $task;

    /**
     * @var Developer
     */
    protected $developer;

    public function setUp(): void
    {
        $this->task = new Task('developer');
        $this->developer = new Developer();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->task);
        unset($this->developer);
        // parent:tearDown();
    }
}
