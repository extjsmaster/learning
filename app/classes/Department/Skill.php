<?php

namespace App\classes\Department;

class Skill
{
    public const  KEY = 'skill';
    public function getKey(): string
    {
        return self::KEY;
    }

    public function hasSkill(Skill $skill): bool
    {
        return $this instanceof $skill;
    }
}
