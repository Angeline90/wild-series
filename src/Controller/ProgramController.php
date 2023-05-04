<?php

namespace App\Controller;

use App\Entity\Program;
use App\Repository\ProgramRepository;
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
}
