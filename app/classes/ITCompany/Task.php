<?php

namespace App\classes\ITCompany;

use DateTime;

class Task
{
    public $skill = '';

    public $status = 'new';

    public $ttl;

    /**
     * @var DateTimeImmutable
     */
    public $begined_at = null;

    /**
     * @var DateTimeImmutable
     */
    public $completed_at = null;

    /**
     * @property Developer $developer
     */
    protected $developer = null;

    public function __construct(string $skill, int $ttl = 1)
    {
        $this->skill = strtolower($skill);
        $this->ttl = $ttl;
    }

    public function setSkill(string $skill)
    {
        $this->skill = strtolower($skill);
    }

    protected function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function begin(Developer $developer)
    {
        if ($this->isNew()) {
            $this->developer = $developer;
            $this->status = 'work';
            $this->begined_at = new \DateTimeImmutable();
        }
    }

    public function complete()
    {
        if ($this->inWork()) {
            $this->status = 'complete';
            $this->completed_at = new \DateTimeImmutable();
        }
    }

    public function isNew(): bool
    {
        return $this->status == 'new';
    }

    public function inWork(): bool
    {
        return $this->status == 'work';
    }

    public function isComplete(): bool
    {
        return $this->status == 'complete';
    }

    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    public function isReady(): bool
    {
        if (is_null($this->begined_at)) {
            return false;
        }
        $expired = $this->begined_at->add(new \DateInterval('P' . $this->ttl . 'D'));

        return  new DateTime() > $expired;
    }
}
