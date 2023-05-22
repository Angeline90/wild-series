<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        
        $episode = new Episode();
        $episode->setTitle('Passé décomposé');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_The Walking Dead'));
        $episode->setSynopsis("Rick Grimes se réveille d'un coma pour découvrir 
            que le monde a été envahi par des zombies. Il part à la recherche de sa famille à Atlanta.");
        
        $manager->persist($episode);

        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Passé décomposé');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Friends'));
        $episode->setSynopsis("Rick Grimes se réveille d'un coma pour découvrir 
            que le monde a été envahi par des zombies. Il part à la recherche de sa famille à Atlanta.");
        
        $manager->persist($episode);

        $manager->flush();

        $episode1 = new Episode();
        $episode1->setTitle('Passé');
        $episode1->setNumber(2);
        $episode1->setSeason($this->getReference('season1_Friends'));
        $episode1->setSynopsis("Rick Grimes se réveille d'un coma pour découvrir 
            que le monde a été envahi par des zombies. Il part à la recherche de sa famille à Atlanta.");
        
        $manager->persist($episode1);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class
        ];
    }
}
