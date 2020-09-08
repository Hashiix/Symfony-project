<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("blog")
     */
    public function index(ArticleRepository $repo)
    {
        return $this->render('blog/index.html.twig',
            ['articles' => $repo->findBy(array(), array('id'=>'DESC'), 10)]);
    }

    /**
     * @Route("/comments", methods={"GET", "POST"})
     */
    public function comments(ArticleRepository $articleRepo, CommentRepository $commentRepo, EntityManagerInterface $em, Request $request)
    {
        $comment = new Comment;

        $form = $this->createFormBuilder($comment)
            ->add('author')
            ->add('comment')
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setArticleId($_GET['id']);
            $comment->setDate(new \DateTime());

            $em->persist($comment);
            $em->flush();
        }

        return $this->render('blog/comments.html.twig', [
            'article' => $articleRepo->find($_GET['id']),
            'comments' => $commentRepo->findBy(array('articleId' => $_GET['id']), array('id'=>'DESC'), 10),
            'commentForm' => $form->createView(),
        ]);
    }
}
