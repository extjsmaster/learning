<?php

namespace App\classes\Department;

class SkillManager
{
    public static function equalSkill(string $first, string $second)
    {
        return strtolower($first) === strtolower($second);
    }

    public static function createSkill(string $key): Skill
    {
        switch($key) {
            default:
                return new Skill();
        }
    }
}
