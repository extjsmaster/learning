<?php

namespace App\Tests\Department;

use App\Tests\TestCase;
use App\classes\Department\SkillManager;

class SkillManagerTest extends TestCase
{
    public function testManager()
    {
        $this->assertTrue(SkillManager::equalSkill('php', 'php'));
        $this->assertTrue(SkillManager::equalSkill('php', 'PHP'));
        $this->assertTrue(SkillManager::equalSkill('php', 'Laravel'));
        $this->assertFalse(SkillManager::equalSkill('php', 'python'));
    }
}
