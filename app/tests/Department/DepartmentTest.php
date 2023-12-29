<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\Department;
use App\classes\Department\Developer;
use App\classes\Department\Task;

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

    public function testDepartment()
    {
        $this->assertCount(0, $this->department->tasks);
        $this->assertCount(0, $this->department->developers);
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

    public function testFindDeveloperBySkill()
    {
        $need = $this->department->findExpectDeveloper('php');
        $this->assertNull($need);
        $developer = new Developer(['php']);
        $this->department->addDeveloper($developer);
        $need = $this->department->findExpectDeveloper('php');
        $this->assertNotNull($need);
        $this->assertTrue($need->hasSkill('php'));
    }

    public function testRunTask()
    {
        $developer = new Developer(['php', 'React']);
        $this->department->addDeveloper($developer);
        $developerSecond = new Developer(['javascript']);
        $this->department->addDeveloper($developer);
        $this->department->addDeveloper($developerSecond);
        $task = new Task('php');
        $this->assertTrue($task->isNew());

        $this->department->addTask($task);
        $taskSecond = new Task('React');
        $this->assertTrue($taskSecond->isNew());

        $this->department->addTask($taskSecond);
        $this->department->runNextTask();
        $this->assertTrue($task->inWork());
        $this->assertFalse($taskSecond->inWork());

        $developerSecond->addSkill('React');
        $this->department->runNextTask();
        $this->assertTrue($taskSecond->inWork());
    }

    public function testUnsetArrayIyemIntoForeach()
    {
        $array = [1,3,5,7,8];
        $newArray = [];
        foreach($array as $index => &$item) {
            if($item == 5) {
                array_splice($array, $index, 1);
                // unset($array[$index]);
            } else {
                $newArray[] = $item;
            }
        }
        $this->assertSame($newArray, $array);
        $this->assertCount(4, $newArray);
    }

    public function testArchiveTask()
    {
        $this->assertCount(0, $this->department->archive);
        $task = new Task('php');
        $this->department->archiveTask($task);
        $this->assertCount(1, $this->department->archive);
    }
}
