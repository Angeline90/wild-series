<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [

       [ 'title' => 'The Walking Dead',
        'synopsis' => "Dans un monde post-apocalyptique envahi par des zombies, un groupe de survivants 
            lutte pour survivre et s'adapter à un nouveau monde impitoyable dans cette série dramatique de survie.",
        'category' => 'Horreur',],

      [  'title' => 'Game of Thrones',
        'synopsis' => "Game of Thrones est une série télévisée de fantasy
            épique qui suit les luttes de pouvoir et les intrigues 
            politiques entre les différentes maisons nobles pour s'emparer du Trône de Fer, 
            dans un monde fictif où la magie et les créatures mythiques coexistent avec les humains.",
        'category' => 'Fantastique',],

       [ 'title' => 'How I Met Your Mother',
        'synopsis' => "How I Met Your Mother est une sitcom qui suit les aventures de Ted Mosby, 
            qui raconte à ses enfants comment il a rencontré leur mère, en compagnie de ses amis 
            Barney, Marshall, Lily et Robin à New York.",
        'category' => 'Humour',],

       [ 'title' => 'Stranger Things',
        'synopsis' => "Après la disparition d'un garçon de leur ville, un groupe d'amis découvre des 
            phénomènes surnaturels et font la rencontre d'une mystérieuse jeune fille aux pouvoirs psychiques 
            dans cette série de science-fiction/horreur des années 80.",
        'category' => 'Horreur',],

       [ 'title' => 'Breaking Bad',
        'synopsis' => "Un professeur de chimie atteint d'un cancer commence à fabriquer de la méthamphétamine 
            pour subvenir aux besoins de sa famille, mais sa transformation en criminel le met en danger et 
            bouleverse sa vie de manière inattendue dans cette série dramatique à suspense.",
        'category' => 'Drame',],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $activeProgram) {
            $program = new Program();
            $program->setTitle($activeProgram['title']);
            $program->setSynopsis($activeProgram['synopsis']);
            $program->setCategory($this->getReference('category_' . $activeProgram['category']));
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}



