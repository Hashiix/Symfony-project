<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/inscription")
     */
    public function index(EntityManagerInterface $em, Request $request, MemberRepository $repo)
    {
        $member = new Member;

        $form = $this->createFormBuilder($member)
            ->add('name')
            ->add('password', PasswordType::class)
            ->add('passwordVerify', PasswordType::class)
            ->add('mail')
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $member->setRegistrationDate(new \DateTime());

            $em->persist($member);
            $em->flush();
        }

        return $this->render('login/index.html.twig', [
            'signInForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/connexion")
     */
    public function login(EntityManagerInterface $em, Request $request, MemberRepository $repo)
    {

        return $this->render('login/login.html.twig');
    }
}
