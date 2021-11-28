<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
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
     * @Route("/article/", name="article_index")
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
     * @Route("/article/show{id}", name="article_show")
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
    /**
     * @Route("/article/category/{id}", name="article_category")
     *
     */
    public function Category(Category $category): Response
    {
        if ($category){
            $articles = $category->getArticles()->getValues();
        }else{
            $articles=null;
            return $this->redirectToRoute('index');
        }

        return $this->render(
            'article/category.html.twig',
            ['articles' => $articles]

        );
    }
}
