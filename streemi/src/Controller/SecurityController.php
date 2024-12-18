<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    

    #[Route(path: '/forget-password', name: 'app_forgot_password')]
    public function forgetPassword(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, LoggerInterface $logger): Response
    {
        // Si la méthode est GET, afficher la vue
        if ($request->isMethod('GET')) {
            return $this->render('auth/forgot.html.twig');
        }

        // Si la méthode est POST, traiter le formulaire
        if ($request->isMethod('POST')) {
            $email = $request->get('_email');

            // Rechercher l'utilisateur avec l'adresse email
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cette adresse email.');
                return $this->redirectToRoute('app_forgot_password');
            }

            // Générer un token unique avec UUID
            $resetToken = Uuid::uuid4()->toString();
            $user->setResetToken($resetToken);

            // Sauvegarder l'utilisateur avec le token en base de données
            $entityManager->persist($user);
            $entityManager->flush();
            $emailMessage = (new TemplatedEmail())
            ->from('noreply@streemi.com')
            ->to($user->getEmail())
            ->subject('Réinitialisation de votre mot de passe')
            ->htmlTemplate('email/reset.html.twig')
            ->context([
                'resetToken' => $resetToken,
                'email_address' => $user->getEmail(), // Renommé pour éviter le conflit
                'resetLink' => $this->generateUrl('app_reset_password', [
                    'token' => $resetToken
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ]);
            $mailer->send($emailMessage);
            $this->addFlash('success', 'Un email de réinitialisation a été envoyé.');
            return $this->redirectToRoute('app_login');
        }

        // Par défaut, rediriger vers la vue forgot.html.twig si une méthode inattendue est utilisée
        return $this->render('auth/forgot.html.twig');
    }
    #[Route(path: '/reset-password/{token}', name: 'app_reset_password')]
    public function resetPassword(
        string $token, 
        Request $request, 
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);
    
        if (!$user) {
            $this->addFlash('error', 'Lien invalide ou expiré.');
            return $this->redirectToRoute('app_forgot_password');
        }
    
        // Si la méthode est GET, afficher le formulaire
        if ($request->isMethod('GET')) {
            return $this->render('auth/reset.html.twig', [
                'token' => $token,
            ]);
        }
    
        // Si la méthode est POST, traiter le formulaire
        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('new_password');
            $confirmPassword = $request->request->get('confirm_password');
    
            // Vérifier que les deux mots de passe correspondent
            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                return $this->render('auth/reset_password.html.twig', [
                    'token' => $token,
                ]);
            }
    
            // Hacher le nouveau mot de passe
            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);
    
            // Supprimer le resetToken après réinitialisation
            $user->setResetToken(null);
    
            // Sauvegarder les changements en base de données
            $entityManager->persist($user);
            $entityManager->flush();
            
    
            $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');
            return $this->redirectToRoute('app_login');
        }
    
        throw $this->createNotFoundException('Méthode non prise en charge.');
    }
    
}
