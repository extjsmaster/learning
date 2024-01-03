<?php

namespace App\classes\ITCompany;

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
