<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category')]
    public function index(
        CategoryRepository $categoryRepository,
        MediaRepository $mediaRepository,
        int $id
    ): Response
    {
        $categories = $categoryRepository->findAll();
        $category = $categoryRepository->find($id);
        return $this->render('other/category.html.twig', [
            "categories" => $categories,
            "categorySelect" => $category,
        ]);
    }
    
    
}
