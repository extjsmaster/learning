<?php

namespace App\Tests\ITCompany\Developer;

use App\Tests\TestCase;
use App\classes\ITCompany\Developer;
use App\classes\ITCompany\Task;

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
