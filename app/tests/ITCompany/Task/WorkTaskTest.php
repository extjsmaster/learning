<?php

namespace App\Tests\ITCompany\Task;

use DateInterval;

class WorkTaskTest extends TaskTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->task->begin($this->developer);
    }
    public function testWorkStatus()
    {
        $this->assertTrue($this->task->inWork());
    }

    public function testBeginedAtDate()
    {
        $this->assertNotNull($this->task->begined_at);
    }

    public function testNotNullDeveloper()
    {
        $this->assertEquals($this->developer, $this->task->getDeveloper());
    }
    public function testBeginFalseAfterComplete()
    {
        $this->task->complete();
        $this->assertTrue($this->task->isComplete());
        $this->task->begin($this->developer);
        $this->assertFalse($this->task->inWork());
    }

    public function testNotExpiredTaskIsNotReady()
    {
        $this->assertFalse($this->task->isReady());
    }
    public function testExpiredTaskIsReady()
    {
        $this->task->begined_at = $this->task->begined_at->sub(new DateInterval('P2D'));
        $this->assertTrue($this->task->isReady());
    }
}
