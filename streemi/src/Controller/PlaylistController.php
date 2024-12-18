<?php
namespace App\Controller;

use App\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PlaylistController extends AbstractController
{
    #[Route('/playlist/list', name: 'app_playlist_list')]
    #[IsGranted('ROLE_USER')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_movie'); 
        }

        $playlists = $entityManager->getRepository(Playlist::class)->findBy(['createdBy' => $user]);

        return $this->render('movie/lists.html.twig', [
            'playlists' => $playlists,
        ]);
    }
}
