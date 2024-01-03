<?php

namespace App\classes\ITCompany;

class Developer
{
    /**
     * @var Skill[]
     */
    public $skills = [];

    /**
     * @var Task
     */
    protected $task = null;

    /**
     * @var SkillManager
     */
    protected $manager;

    public function __construct(array $skills = [])
    {
        $this->manager = new SkillManager();
        foreach($skills as $skill) {
            $this->addSkill($skill);
        }
    }

    public function addSkill(string $skill)
    {
        if (!array_key_exists($skill, $this->skills)) {
            $this->skills[$skill] = $this->manager->createSkill($skill);
        }
    }

    public function hasSkill(string $skillName)
    {
        if(array_key_exists($skillName, $this->skills)) {
            return true;
        }
        foreach($this->skills as $key => $skill) {
            $className = $this->manager->getSkillClass($skillName);
            if($skill instanceof $className) {
                return true;
            }
        }
        return false;
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
