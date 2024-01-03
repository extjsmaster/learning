<?php

namespace App\classes\ITCompany;

use App\classes\ITCompany\Skills\DjangoSkill;
use App\classes\ITCompany\Skills\JSSkill;
use App\classes\ITCompany\Skills\LaravelSkill;
use App\classes\ITCompany\Skills\PHPSkill;
use App\classes\ITCompany\Skills\ProgrammingSkill;
use App\classes\ITCompany\Skills\PythonSkill;
use App\classes\ITCompany\Skills\ReactSkill;
use App\classes\ITCompany\Skills\SymfonySkill;

class SkillManager
{
    protected $aliases = [
        'php' => PHPSkill::class,
        'js' => JSSkill::class,
        'javascript' => JSSkill::class,
        'python' => PythonSkill::class,
        'laravel' => LaravelSkill::class,
        'symfony' => SymfonySkill::class,
        'react' => ReactSkill::class,
        'django' => DjangoSkill::class,
        'programming' => ProgrammingSkill::class
    ];
    public function getSkillClass(string $skill): string
    {
        return $this->aliases[strtolower($skill)] ?: Skill::class;
    }
    public function createSkill(string $skill): Skill
    {
        $className = $this->getSkillClass($skill);
        return new $className();
    }

    public function createSkills(array $skills): array
    {
        return array_map(function ($skill) {return $this->createSkill($skill);}, $skills);
    }
}
