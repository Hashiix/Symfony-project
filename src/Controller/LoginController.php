<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/connexion", methods={"GET", "POST"})
     */
    public function login(EntityManagerInterface $em, Request $request, MemberRepository $repo)
    {
        return $this->render('login/index.html.twig');
    }

    /**
     * @Route("/deconnexion")
     */
    public function logout()
    {

    }
}
