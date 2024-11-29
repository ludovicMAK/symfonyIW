<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/movie/detail-serie', name: 'app_movie_detail_serie')]
    public function detailSerie(): Response
    {
        return $this->render('movie/detail_serie.html.twig');
    }
    #[Route('/movie/detail', name: 'app_movie_detail')]
    public function detail(): Response
    {
        return $this->render('movie/detail.html.twig');
    }
    #[Route('/movie/discover', name: 'app_movie_discover')]
    public function discover(
        CategoryRepository $categoryRepository
    ): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('movie/discover.html.twig',['categories' => $categories]);
    }
    #[Route('/', name: 'app_movie')]
    public function index(
        MovieRepository $movieRepository
    ): Response
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', ['movies' => $movies]);
    }
    #[Route('/movie/list', name: 'app_movie_list')]
    public function list(): Response
    {
        return $this->render('movie/lists.html.twig');
    }
}
