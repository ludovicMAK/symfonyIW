<?php

namespace App\Controller;

use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AbonnementController extends AbstractController
{

    #[Route('/abonnement', name: 'app_abonnement')]
    #[IsGranted('ROLE_USER')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $subscriptions = $subscriptionRepository->findAll();
        $user = $this->getUser();
    
        // Obtenir l'abonnement actuel de l'utilisateur
        $currentSubscription = null;
        if ($user) {
            foreach ($user->getSubscriptions() as $subscription) {
                $currentSubscription = $subscription;
                break; // Vous pouvez adapter cela selon votre logique pour déterminer l'abonnement actif.
            }
        }
        return $this->render('abonnement/abonnements.html.twig', [
            'subscriptions' => $subscriptions,
            'currentSubscription' => $currentSubscription
        ]);
    }
    
}
