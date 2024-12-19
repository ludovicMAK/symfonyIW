<?php
namespace App\Controller;

use App\Entity\Playlist;
use App\Repository\MediaRepository;
use App\Repository\PlaylistMediaRepository;
use App\Repository\PlaylistRepository;
use App\Repository\PlaylistSubcriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PlaylistController extends AbstractController
{
    #[Route('/playlist/list', name: 'app_playlist_list')]
    #[IsGranted('ROLE_USER')]
    public function list(PlaylistRepository $playlistRepository,PlaylistSubcriptionRepository $playlistSubscriptionRepository,Request $request, MediaRepository $mediaRepository,PlaylistMediaRepository $playlistMediaRepository): Response

    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_movie'); 
        }


        $playlistsSubscribed = $playlistSubscriptionRepository->findBy(['subscriber' => $user]);
        foreach ($playlistsSubscribed as $playlistSubscribed) {
            $playlists []= $playlistRepository->findBy(['id' => $playlistSubscribed->getPlaylist()->getId()])[0];
        }

        if($request->query->get('selectedPlaylist')){
            $selectedPlaylistId = $request->query->get('selectedPlaylist');
            $playlistsSelect = current(array_filter($playlists, function ($item) use ($selectedPlaylistId) {
                return $item->getId() == $selectedPlaylistId;
            }));
            $playlistMedia = $playlistMediaRepository->findBy(['playlist' => $playlistsSelect]);
            $medias = [];
            foreach ($playlistMedia as $media) {
                $medias []= $mediaRepository->findBy(['id' => $media->getMedia()->getId()])[0];
            }

        }
        return $this->render('movie/lists.html.twig', [
            'playlists' => $playlists,
            'medias' => $medias ?? [],
            'idSelectPlaylist'=> $request->query->get('selectedPlaylist') ?? null
        ]);
    }
}
