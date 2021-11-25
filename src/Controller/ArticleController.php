<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $articleRepository;

        public function __construct(ArticleRepository $articleRepository)
        {
            $this->articleRepository= $articleRepository;

        }

    /**
     * @Route("/", name="index")
     *
     * @return Response A response instance
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $this->articleRepository
             ->findAll();

        return $this->render(
             'article/index.html.twig',
             ['articles' => $articles]
         );
    }

    /**
     * @Route("/show{id}", name="show")
     *
     * @return Response A response instance
     */
    public function show(Article $article): Response
    {

        if (!$article) {
            return $this->redirectToRoute('index'); // code...
        }

        return $this->render(
             'article/show.html.twig',
             ['article' => $article]
         );
    }
}
