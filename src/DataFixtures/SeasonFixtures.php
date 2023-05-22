<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//Tout d'abord nous ajoutons la classe Factory de FakerPhp
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_SEASONS = 5;
    
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        //for($i = 0; $i < 50; $i++) {

        foreach(ProgramFixtures::PROGRAMS as $program) {
            $seasonNumber = 1;
        
            while ($seasonNumber <= self::NB_SEASONS) {
            $season = new Season();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $season->setNumber($seasonNumber);
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraphs(1, true));
            $title = $program['title'];

            $season->setProgram($this->getReference('program_' . $title));

            $manager->persist($season);
            $this->addReference('season_' . $seasonNumber . '_' . $title, $season);
            $seasonNumber++;

            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
           ProgramFixtures::class,
        ];
    }
}
