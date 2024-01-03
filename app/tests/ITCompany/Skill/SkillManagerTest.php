<?php

namespace App\Tests\ITCompany\Skill;

use App\classes\ITCompany\Skill;
use App\Tests\TestCase;
use App\classes\ITCompany\SkillManager;
use App\classes\ITCompany\Skills\PHPSkill;
use App\classes\ITCompany\Skills\JSSkill;
use App\classes\ITCompany\Skills\PythonSkill;

class SkillManagerTest extends TestCase
{
    /**
     * @var SkillManager
     */
    protected $manager;
    protected function setUp(): void
    {
        $this->manager  = new SkillManager();
    }
    public function testGetSkillClass()
    {
        $this->assertEquals(PHPSkill::class, $this->manager->getSkillClass('php'));
        $this->assertEquals(JSSkill::class, $this->manager->getSkillClass('js'));
        $this->assertEquals(PythonSkill::class, $this->manager->getSkillClass('python'));
    }

    public function testCreateSkill()
    {
        $skill = $this->manager->createSkill('php');
        $this->assertEquals('php', $skill::KEY);
        $this->assertInstanceOf(PHPSkill::class, $skill);
    }

    public function testCreateSkills()
    {
        $this->assertContainsOnlyInstancesOf(Skill::class, $this->manager->createSkills(['php','js']));
    }
}
