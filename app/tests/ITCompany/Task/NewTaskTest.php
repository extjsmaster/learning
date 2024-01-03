<?php

namespace App\Tests\ITCompany\Task;

class NewTaskTest extends TaskTest
{
    public function testExpectedSkill()
    {
        $this->assertEquals('developer', $this->task->skill);
    }
    public function testSetSkill()
    {
        $this->task->setSkill('javascript');
        $this->assertEquals('javascript', $this->task->skill);
    }
    public function testNewStatus()
    {
        $this->assertTrue($this->task->isNew());

    }
    public function testHasNotDeveloper()
    {
        $this->assertNull($this->task->getDeveloper());
    }

    public function testHasNullBeginedAtDate()
    {
        $this->assertNull($this->task->begined_at);

    }
    public function testHasNullCompletedAtDate()
    {
        $this->assertNull($this->task->completed_at);

    }
    public function testIsNotReady()
    {
        $this->assertFalse($this->task->isReady());
    }

    public function testCannotComplete()
    {
        $this->task->complete();
        $this->assertFalse($this->task->isComplete());
        $this->assertTrue($this->task->isNew());
    }
}
