<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog")
     */
    public function index(ArticleRepository $repo)
    {
        return $this->render('blog/index.html.twig',
            ['articles' => $repo->findBy(array(), array('id'=>'DESC'), 10)]);
    }

    /**
     * @Route("/comments", methods={"GET", "POST"})
     */
    public function comments(ArticleRepository $articleRepo, CommentRepository $commentRepo)
    {
        return $this->render('blog/comments.html.twig',
            ['articles' => $articleRepo->findBy(array(), array('id'=>'DESC'), 10)]);
    }
}
