<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ConnectForm;
use App\Form\UserForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $req, UserRepository $repository, UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();

        $form = $this->createForm(UserForm::class, $user);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $emailExist = $repository->findOneBy(['email' => $user->getEmail()]);
            if ($emailExist) {
                return $this->redirectToRoute('inscription', ['error' => 'USER_EXIST']);
            };
            $email = $user->getEmail();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            $pseudo = $user->getPseudo();

            $repository->sauvegarder($user, true);

            return $this->redirectToRoute('connexion', ['succes' => 'NEW_USER']);
        }

        return $this->render('pages/inscription.html.twig', ['UserForm' => $form->createView()]);
    }

    #[Route('/connexion', name: 'connexion')]
    public function connexion(AuthenticationUtils $authenticationUtils)
    {   
        $form = $this->createForm(ConnectForm::class);

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('pages/connexion.html.twig', [
            'last_email' => $lastEmail,
            'error' => $error,
            'ConnectForm' => $form->createView()
        ]);
    }

    #[Route('/deconnexion', name: 'deconnexion')]
    public function deconnexion(){
        
    }
}
