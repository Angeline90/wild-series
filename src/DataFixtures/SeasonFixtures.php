<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_The Walking Dead'));
        $season->setYear(2010);
        $season->setDescription('ça fait peur');
        $manager->persist($season);
        $this->addReference('season1_The Walking Dead', $season);

        $season = new Season();
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_Friends'));
        $season->setDescription('hahaha');
        $season->setYear(2010);
        $manager->persist($season);
        $this->addReference('season1_Friends', $season);

        $manager->flush();

        $season1 = new Season();
        $season1->setNumber(2);
        $season1->setProgram($this->getReference('program_Friends'));
        $season1->setDescription('hahaha');
        $season1->setYear(2010);
        $manager->persist($season1);
        $this->addReference('season2_Friends', $season1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}
