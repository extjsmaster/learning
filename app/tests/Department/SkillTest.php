<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\Skill;
use App\classes\Department\Skills\DjangoSkill;
use App\classes\Department\Skills\JSSkill;
use App\classes\Department\Skills\LaravelSkill;
use App\classes\Department\Skills\PHPSkill;
use App\classes\Department\Skills\ProgrammingSkill;
use App\classes\Department\Skills\PythonSkill;
use App\classes\Department\Skills\ReactSkill;
use App\classes\Department\Skills\SymfonySkill;

class SkillTest extends TestCase
{
    /**
     * base skill class
     * @var Skill
     */
    protected $skill;
    protected function setUp(): void
    {
        $this->skill = new ProgrammingSkill();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->skill);
        // parent:tearDown();
    }
    public function testCreate()
    {
        $this->assertEquals('skill', $this->skill->getKey());
    }

    public function testBetweenSameSkills()
    {
        $skill2 = new ProgrammingSkill();
        $this->assertTrue($this->skill->hasSkill($skill2));
    }
    public function testChildHasParentSkill()
    {
        $php = new PHPSkill();
        $this->assertTrue($php->hasSkill($this->skill));
        $laravel = new LaravelSkill();
        $this->assertTrue($laravel->hasSkill($php));
        $symfony = new SymfonySkill();
        $this->assertTrue($symfony->hasSkill($php));

        $js = new JSSkill();
        $this->assertTrue($js->hasSkill($this->skill));

        $react = new ReactSkill();
        $this->assertTrue($react->hasSkill($js));

        $python = new PythonSkill();
        $this->assertTrue($python->hasSkill($this->skill));

        $django = new DjangoSkill();
        $this->assertTrue($django->hasSkill($python));
    }

    public function testChildHasGrandParentSkill()
    {
        $laravel = new LaravelSkill();
        $this->assertTrue($laravel->hasSkill($this->skill));
    }
    public function testParentHasNotChildSkill()
    {
        $js = new JSSkill();

        $this->assertFalse($this->skill->hasSkill($js));
    }
    public function testChildrenHasNotSameSkill()
    {
        $php = new PHPSkill();
        $js = new JSSkill();
        $this->assertFalse($php->hasSkill($js));
        $this->assertFalse($js->hasSkill($php));
    }
}
