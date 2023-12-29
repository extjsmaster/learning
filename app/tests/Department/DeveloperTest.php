<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\Developer;
use App\classes\Department\Task;

abstract class DeveloperTest extends TestCase
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
}
