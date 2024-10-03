<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/auth/confirm', name: 'app_auth_confirm')]
    public function confim(): Response
    {
        return $this->render('auth/confirm.html.twig');
    }
    #[Route('/auth/forgot', name: 'app_auth_forgot')]
    public function forgot(): Response
    {
        return $this->render('auth/forgot.html.twig');
    }
    #[Route('/auth/login', name: 'app_auth_login')]
    public function login(): Response
    {
        return $this->render('auth/login.html.twig');
    }
    #[Route('/auth/register', name: 'app_auth_register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }
    #[Route('/auth/reset', name: 'app_auth_reset')]
    public function reset(): Response
    {
        return $this->render('auth/reset.html.twig');
    }
}
