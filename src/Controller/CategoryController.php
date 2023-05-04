<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[route('/category', name: 'category_')]
class CategoryController extends AbstractController {

    #[route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response {

        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    #[route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, 
        ProgramRepository $programRepository): Response {
        
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        $programs =[];

        if(!$category){
           throw $this->createNotFoundException(
            'Aucune catégorie avec le nom : ' . $categoryName . ' trouvée.');
        }else {
            $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3);
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
        
    }
}