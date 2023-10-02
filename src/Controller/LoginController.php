<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authtUtils): Response
    {
        // pegar erro do Login, caso exista
        $error = $authtUtils->getLastAuthenticationError();

        // pegar o último email informado pelo usuário;
        $lastUserName = $authtUtils->getLastUsername();
        
        return $this->render('login/index.html.twig', [
            'error' => $error,
            'lastUsername' => $lastUserName,
        ]);
    }
}
