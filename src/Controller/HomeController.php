<?php

namespace App\Controller;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $articleRepository;
    private $categoryRepository;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;

    }

    /**
     * @Route("/", name="index")
     *
     * @return Response A response instance
     */
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $this->articleRepository
            ->findAll();
        $categories = $this->categoryRepository
            ->findAll();

        return $this->render(
            'home/index.html.twig',
            [
                'articles' => $articles,
                'categories' => $categories
            ]

        );
    }
}
