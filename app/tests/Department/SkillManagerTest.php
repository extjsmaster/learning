<?php

namespace App\Tests\Department;

use App\classes\Department\Skill;
use App\Tests\TestCase;
use App\classes\Department\SkillManager;
use App\classes\Department\Skills\PHPSkill;
use App\classes\Department\Skills\JSSkill;
use App\classes\Department\Skills\PythonSkill;
class SkillManagerTest extends TestCase
{
    /**
     * @var SkillManager
     */
    protected $manager;
    protected function setUp(): void
    {
        $this->manager  = new SkillManager;
    }
    public function testGetSkillClass()
    {
        $this->assertEquals(PHPSkill::class, $this->manager->getSkillClass('php'));
        $this->assertEquals(JSSkill::class, $this->manager->getSkillClass('js'));
        $this->assertEquals(PythonSkill::class, $this->manager->getSkillClass('python'));
    }

    public function testCreateSkill(){
        $skill = $this->manager->createSkill('php');
        $this->assertEquals('php', $skill::KEY);
        $this->assertInstanceOf(PHPSkill::class, $skill);
    }

    public function testCreateSkills(){
        $this->assertContainsOnlyInstancesOf(Skill::class, $this->manager->createSkills(['php','js']));
    }
}
