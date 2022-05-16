<?php

namespace App\DataFixtures;

use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sections=["math","physique","chimie","histoire","geo","francais","anglais"];
        for($i=0;$i<7;$i++){
            $section = new Section();
            $section->setDesignation($sections[$i]);
            $manager->persist($section);
        }

        $manager->flush();
    }
}
