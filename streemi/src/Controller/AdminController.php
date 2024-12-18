<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin/add-film', name: 'app_admin_add')]
    #[IsGranted('ROLE_ADMIN')]
    public function addFilm(): Response
    {
        return $this->render('admin/admin_add_films.html.twig');
    }

    #[Route('/admin/film', name: 'app_admin_film')]
    #[IsGranted('ROLE_ADMIN')]
    public function film(): Response
    {
        return $this->render('admin/admin_films.html.twig');
    }
    #[Route('/admin/user', name: 'app_admin_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function user(): Response
    {
        return $this->render('admin/admin_users.html.twig');
    }
    
    #[Route('/admin/film', name: 'app_admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function dasboard(): Response
    {
        return $this->render('admin/admin.html.twig');
    }
}
