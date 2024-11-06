<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    #[Route('/profil', name: 'profil')]
    public function profil()
    {
        $user = $this->getUser();
        return $this->render('pages/profil.html.twig');
    }
//verifier si l'utilisateur est bien connecter sans juste taper profil dans l'url
}
