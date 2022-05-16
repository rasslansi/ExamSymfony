<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $repository = $manager->getRepository(Section::class);
        $fake = Factory::create('fr_FR');
        for($i=0;$i<40;$i++){
            $etudiant = new Etudiant();
            $etudiant->setPrenom($fake->firstName);
            $etudiant->setNom($fake->name);
            $section= $repository->findOneBy(['id'=>$i]);
            $etudiant->setSection($section);
            $manager->persist($etudiant);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SectionFixtures::class
        ];
    }
}
