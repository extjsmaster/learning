<?php

namespace App\classes\Department;

class Department
{
    /**
     * @var Task[]
     */
    public $tasks = [];

    /**
     * @var Task[]
     */
    public $archive = [];

    public $developers = [];

    public function addDeveloper(Developer $developer)
    {
        $this->developers[] = $developer;
    }

    public function addTask(Task $task)
    {
        $this->tasks[] = $task;
    }

    public function archiveTask(Task $task)
    {
        $this->archive[] = $task;

    }
    public function findExpectDeveloper(string $skill): ?Developer
    {
        if (count($this->developers) == 0) {
            return null;
        }
        foreach ($this->developers as $developer) {
            if (!($developer->isBusy()) && $developer->hasSkill(strtolower($skill))) {
                return $developer;
            }
        }

        return null;
    }

    public function completeTask(Task &$task): bool
    {
        if ($task->inWork() && $task->isReady()) {
            $task->getDeveloper()->completeTask();
            $this->archiveTask($task);
            return true;
        }
        return false;
    }
    public function runNextTask()
    {
        foreach ($this->tasks as $index => $task) {
            if($this->completeTask($task)) {
                array_splice($this->tasks, $index, 1);
                continue;
            }
            $developer = $this->findExpectDeveloper($task->skill);
            if ($developer) {
                $developer->beginTask($task);
            }
        }
    }
}
