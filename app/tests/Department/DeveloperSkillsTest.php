<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\Developer;
use App\classes\Department\Task;

class DeveloperSkillsTest extends DeveloperTest
{
    public function testEmptySkills()
    {
        $this->assertCount(0, $this->developer->skills);
    }
    public function testCreateWithSkills()
    {
        $developer = new Developer(['php', 'javascript']);
        $this->assertCount(2, $developer->skills);
    }

    public function testAddSkill()
    {
        $this->developer->addSkill('php');
        $this->assertCount(1, $this->developer->skills);
    }

    public function testAddSkillAlreadyExists()
    {
        $this->developer->addSkill('php');
        $this->developer->addSkill('php');
        $this->assertCount(1, $this->developer->skills);
    }

    public function testHasSkill()
    {
        $this->developer->addSkill('php');
        $this->assertTrue($this->developer->hasSkill('php'));
    }
    public function testHasNotSkill()
    {
        $this->developer->addSkill('php');
        $this->assertFalse($this->developer->hasSkill('Laravel'));
    }
    public function testHasParentSkill()
    {
        $this->developer->addSkill('laravel');
        $this->assertTrue($this->developer->hasSkill('php'));
    }
}
