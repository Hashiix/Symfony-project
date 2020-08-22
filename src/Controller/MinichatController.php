<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MinichatController extends AbstractController
{
    /**
     * @Route("/", name="minichat", methods={"POST", "GET"})
     */
    public function index(MessageRepository $repo, Request $request, EntityManagerInterface $em)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            $message = new Message;
            $message->setName($data['name']);
            $message->setMessage($data['message']);
            $message->setDate(new \DateTime());

            $em->persist($message);
            $em->flush();
        }
        return $this->render('minichat/index.html.twig', ['messages' => $repo->findBy(array(), array('id'=>'DESC'), 10)]);
    }
}