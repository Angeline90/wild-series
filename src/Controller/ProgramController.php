<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('program/index.html.twig', [

            'programs' => $programs,
     
         ]);
    }

    #[Route('/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(Program $programId, ProgramRepository $programRepository): Response
    {
        $programRepository->findOneBy(['id' => $programId]);

        if(!$programId) {
            throw $this->createNotFoundException(
                'Aucun programme trouvé avec l\'id : ' 
                    .$programId.'dans la table des programmes.');
        }
        return $this->render('program/show.html.twig', ['program' => $programId]);
    }

    #[Route('/show/{programId}/seasons/{seasonId}', name: 'season_show', requirements: ['programId' => '\d+', 'seasonId' => '\d+'], methods: ['GET'])]
    public function showSeason(Program $programId, Season $seasonId): Response
    {
        
        //  dd($seasonId);
        // dd($program);
        return $this->render('program/season_show.html.twig', [
            'program' => $programId,
            'season' => $seasonId,
        ]);
    }
}
