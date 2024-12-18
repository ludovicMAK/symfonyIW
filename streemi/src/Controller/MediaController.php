<?php

namespace App\Controller;

use App\Enum\MediaTypeStatusEnum;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use App\Repository\MovieRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
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
    #[Route('/discover/{mediaType?MediaTypeStatusEnum}', name: 'app_movie_discover')]
    public function discover(
        CategoryRepository $categoryRepository,
        MovieRepository $movieRepository,
        SerieRepository $serieRepository,
        string $mediaType = MediaTypeStatusEnum::MOVIE->value,
    ): Response {
        $categories = $categoryRepository->findAll();
        $medias = $mediaType === MediaTypeStatusEnum::MOVIE->value
            ? $movieRepository->findAll()
            : $serieRepository->findAll();
        return $this->render('movie/discover.html.twig', ['medias' => $medias, 'categories' => $categories]);
    }
    #[Route('/accueil', name: 'app_movie')]
    public function index(
        MovieRepository $movieRepository,
        SerieRepository $serieRepository,
        string $mediaType = MediaTypeStatusEnum::MOVIE->value,
    ): Response {
        $medias = $mediaType === MediaTypeStatusEnum::MOVIE->value
            ? $movieRepository->findAll()
            : $serieRepository->findAll();
        return $this->render('movie/index.html.twig', ['medias' => $medias]);
    }
}
