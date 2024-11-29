<?php

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(
        SubscriptionRepository $subscriptionRepository
    ): Response
    {
        $subscriptions = $subscriptionRepository->findAll();
        return $this->render('abonnement/abonnements.html.twig', [
            'controller_name' => 'AbonnementController',
            'subscriptions'=> $subscriptions
        ]);
    }
}
