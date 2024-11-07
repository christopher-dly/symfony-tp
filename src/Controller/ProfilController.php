<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function profil()
    {
        $user = $this->getUser();
        return $this->render('pages/profil.html.twig');
    }

    #[Route('/profil/modifier', name: 'profil-modifier')]
    public function modifierProfil(Request $req, UserRepository $repository, #[Autowire('%kernel.project_dir%/public/img')] $avatarDirectory, SluggerInterface $slugger)
    {
        $email = $this->getUser()->getUserIdentifier();

        $user = $repository->findOneBy(['email' => $email]);

        $form = $this->createForm(ProfilForm::class, $user);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {

            $avatarFile = $form->get('avatar')->getData();
                if ($avatarFile){
                    $originalFileName = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFileName = $slugger->slug($originalFileName);
                    $newFileName = 'img/'.$safeFileName.'.'.$avatarFile->guessExtension();

                    try {
                        $avatarFile->move($avatarDirectory, $newFileName);
                    } catch (FileException $e) {

                    }
                    $user->setAvatar($newFileName);
                }

            $repository->sauvegarder($user, true);

            return $this->redirectToRoute('profil', ['succes' => 'UPDATE_USER']);
        }

        return $this->render('pages/modifierProfil.html.twig', ['ProfilForm' => $form]);
    }
}
