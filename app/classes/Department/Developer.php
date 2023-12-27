<?php

namespace App\classes\Department;

class Developer
{
    /**
     * @var string[]
     */
    public $skills = [];

    /**
     * @var Task
     */
    protected $task = null;

    public function __construct(array $skills = [])
    {
        $this->skills = $skills;
    }

    public function addSkill(string $skill)
    {
        if (!in_array($skill, $this->skills)) {
            $this->skills[] = $skill;
        }
    }

    public function hasSkill(string $skill)
    {
        return in_array($skill, $this->skills);
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function beginTask(Task $task)
    {
        $task->begin($this);
        $this->task = $task;
    }

    public function completeTask()
    {
        if ($this->task) {
            $this->task->complete();
            $this->task = null;
        }
    }

    public function isBusy()
    {
        return !is_null($this->task);
    }
}
