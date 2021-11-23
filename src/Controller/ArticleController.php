<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @return Response A response instance
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
             ->getRepository(Article::class)
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
    public function show($id): Response
    {
        $article = $this->getDoctrine()
             ->getRepository(Article::class)
             ->find($id);
        if (!$article) {
            return $this->redirectToRoute('index'); // code...
        }

        return $this->render(
             'article/show.html.twig',
             ['article' => $article]
         );
    }
}
