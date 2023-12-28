<?php

namespace App\Tests\functional\classes\Learning\Department;

use App\Tests\TestCase;
use App\classes\Department\Skill;
use App\classes\Department\Skills\JSSkill;
use App\classes\Department\Skills\PHPSkill;
use App\classes\Department\Skills\ReactSkill;

class SkillTest extends TestCase
{
    public function testCreate()
    {
        $skill = new Skill();
        $this->assertEquals('skill', $skill->getKey());
    }

    public function testHasSkill(){
        $skill = new Skill();
        $skill2 = new Skill();
        $this->assertTrue($skill->hasSkill($skill2));

        $php = new PHPSkill();
        $this->assertTrue($php->hasSkill($skill));

        $js = new JSSkill();

        $this->assertFalse($php->hasSkill($js));
        $this->assertFalse($skill->hasSkill($js));

        $react = new ReactSkill();
        $this->assertTrue($react->hasSkill($js));

    }
}
