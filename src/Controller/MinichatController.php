<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MinichatController extends AbstractController
{
    /**
     * @Route("/", name="minichat")
     */
    public function index()
    {
        return $this->render('minichat/index.html.twig', [
            'controller_name' => 'MinichatController',
        ]);
    }
}
