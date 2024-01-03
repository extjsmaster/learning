<?php

namespace App\Tests\ITCompany\Department;

use DateInterval;
use App\Tests\TestCase;
use App\classes\ITCompany\Department;
use App\classes\ITCompany\Developer;
use App\classes\ITCompany\Task;

use function PHPUnit\Framework\assertCount;

class DepartmentTest extends TestCase
{
    /**
     * @var Department
     */
    protected $department;

    protected function setUp(): void
    {
        $this->department = new Department();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->department);
        // parent:tearDown();
    }

    public function testEmptyTasks()
    {
        $this->assertCount(0, $this->department->tasks);
    }
    public function testEmptyDevelopers()
    {
        $this->assertCount(0, $this->department->developers);
    }
    public function testEmptyArchive()
    {
        $this->assertCount(0, $this->department->archive);
    }
    public function testAddDeveloper()
    {
        $dev = new Developer();
        $this->department->addDeveloper($dev);
        $this->assertCount(1, $this->department->developers);
    }

    public function testAddTask()
    {
        $task = new Task('php');
        $this->department->addTask($task);
        $this->assertCount(1, $this->department->tasks);
    }

    public function testNotFindDeveloperBySkill()
    {
        $need = $this->department->findExpectDeveloper('php');
        $this->assertNull($need);
    }
    public function testFindDeveloperBySkill()
    {
        $developer = new Developer(['php']);
        $this->department->addDeveloper($developer);
        $need = $this->department->findExpectDeveloper('php');
        $this->assertNotNull($need);
        $this->assertTrue($need->hasSkill('php'));
    }

    public function testRunTask()
    {
        $developer = new Developer(['php', 'react']);
        $this->department->addDeveloper($developer);
        $developerSecond = new Developer(['javascript']);
        $this->department->addDeveloper($developer);
        $this->department->addDeveloper($developerSecond);
        $task = new Task('php');
        $this->assertTrue($task->isNew());

        $this->department->addTask($task);
        $taskSecond = new Task('react');
        $this->assertTrue($taskSecond->isNew());

        $this->department->addTask($taskSecond);
        $this->department->runNextTask();
        $this->assertTrue($task->inWork());
        $this->assertFalse($taskSecond->inWork());

        $developerSecond->addSkill('react');
        $this->department->runNextTask();
        $this->assertTrue($taskSecond->inWork());
    }

    public function testArchiveTask()
    {
        $this->assertCount(0, $this->department->archive);
        $task = new Task('php');
        $this->department->archiveTask($task);
        $this->assertCount(1, $this->department->archive);
    }
    public function testCompleteNewTask()
    {
        $task = new Task('php');
        $this->department->addTask($task);
        $this->assertFalse($this->department->completeTask($task));
    }

    protected function beginTask(): Task
    {
        $task = new Task('php');
        $this->department->addTask($task);
        $developer = new Developer(['php', 'react']);
        $this->department->addDeveloper($developer);
        $task->begin($developer);
        return $task;
    }
    public function testCompleteWorkingTask()
    {
        $task = $this->beginTask();
        $task->begined_at = $task->begined_at->sub(new DateInterval('P2D'));
        $this->assertTrue($this->department->completeTask($task));
        $this->assertCount(1, $this->department->archive);
    }
    public function testArchiveCountAfterCompleteTask()
    {
        $task = $this->beginTask();
        $task->begined_at = $task->begined_at->sub(new DateInterval('P2D'));
        $this->department->completeTask($task);
        $this->assertCount(1, $this->department->archive);
    }
    public function testTaskStatusAfterCompleteTask()
    {
        $task = $this->beginTask();
        $task->begined_at = $task->begined_at->sub(new DateInterval('P2D'));
        $this->department->completeTask($task);
        $this->assertTrue($task->isComplete());
    }
}
