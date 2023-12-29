<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\Developer;
use App\classes\Department\Task;

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
}
