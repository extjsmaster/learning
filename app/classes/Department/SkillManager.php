<?php

namespace App\classes\Department;

use App\classes\Department\Skills\DjangoSkill;
use App\classes\Department\Skills\JSSkill;
use App\classes\Department\Skills\LaravelSkill;
use App\classes\Department\Skills\PHPSkill;
use App\classes\Department\Skills\ProgrammingSkill;
use App\classes\Department\Skills\PythonSkill;
use App\classes\Department\Skills\ReactSkill;
use App\classes\Department\Skills\SymfonySkill;

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

    public function createSkills(array $skills): array {
       return array_map(function($skill){return $this->createSkill($skill);}, $skills);    
    }
}
