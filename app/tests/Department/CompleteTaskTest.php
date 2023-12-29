<?php

namespace App\Tests\Department;

class CompleteTaskTest extends TaskTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->task->begin($this->developer);
        $this->task->complete();
    }
    public function testCompleteStatus()
    {
        $this->assertTrue($this->task->isComplete());
    }

    public function testNotNullCompletedAtDate()
    {
        $this->assertNotNull($this->task->completed_at);
    }

    public function testNullDeveloper()
    {
        $this->assertNull($this->task->getDeveloper());
    }

}
