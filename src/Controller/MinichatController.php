<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MinichatController extends AbstractController
{
    /**
     * @Route("/", methods={"POST", "GET"})
     */
    public function index(MessageRepository $repo, Request $request, EntityManagerInterface $em)
    {
        $message = new Message;

        $form = $this->createFormBuilder($message)
            ->add('name')
            ->add('message')
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setDate(new \DateTime());

            $em->persist($message);
            $em->flush();
        }

        return $this->render('minichat/index.html.twig', [
            'messages' => $repo->findBy(array(), array('id'=>'DESC'), 15),
            'chatForm' => $form->createView()
        ]);
    }
}