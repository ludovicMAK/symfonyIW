<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Serie;
use App\Enum\MediaTypeStatusEnum;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use App\Repository\MovieRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{

    #[Route('/movie/detail/{id}', name: 'app_movie_detail')]
    public function detail(
        MediaRepository $mediaRepository,
        MovieRepository $movieRepository,
        SerieRepository $serieRepository,
        int $id
    ): Response
    {
        $media = $mediaRepository->find($id);
        if($media instanceof Movie) {
            $media = $movieRepository->find($id);
            return $this->render('movie/detail.html.twig', ['movie' => $media]);

        } else if($media instanceof Serie) {
            $media = $serieRepository->find($id);
            return $this->render('movie/detail_serie.html.twig', ['serie' => $media]);
        }
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
        Request $request,
        MovieRepository $movieRepository,
        SerieRepository $serieRepository,
        MediaRepository $mediaRepository
    ): Response {
        $mediaType = $request->query->get('mediaType', MediaTypeStatusEnum::MOVIE->value);
        $medias = $mediaType === MediaTypeStatusEnum::MOVIE->value
            ? $movieRepository->findAll()
            : $serieRepository->findAll();
        $mediaPopular = $mediaRepository->findPopular();
        return $this->render('movie/index.html.twig', ['medias' => $medias, 'mediaPopular' => $mediaPopular]);
    }
    
}
