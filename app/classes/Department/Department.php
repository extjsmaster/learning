<?php

namespace App\classes\Department;

class Department
{
    public $tasks = [];

    public $developers = [];

    public function addDeveloper(Developer $developer)
    {
        $this->developers[] = $developer;
    }

    public function addTask(Task $task)
    {
        $this->tasks[] = $task;
    }

    public function findExpectDeveloper(string $skill): ?Developer
    {
        if (count($this->developers) == 0) {
            return null;
        }
        foreach ($this->developers as $developer) {
            if (!($developer->isBusy()) && $developer->hasSkill($skill)) {
                return $developer;
            }
        }

        return null;
    }

    public function runNextTask()
    {
        foreach ($this->tasks as $task) {
            if ($task->isReady()) {
                continue;
            }
            $developer = $this->findExpectDeveloper($task->skill);
            if ($developer) {
                $developer->beginTask($task);
            }
        }
    }
}
