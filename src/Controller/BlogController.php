<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleCategory;
use App\Repository\ArticleRepository;
use App\Repository\ArticleCategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();

        //$articles->setCategory($category);   ManyToOne je ne sais pas si ça marche

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/blog/home", name="homeblog")
     */
    public function homeblog()
    {
        return $this->render('blog/homeblog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

     /**
     * @Route("blog/article/{id}", name="article", methods={"GET"})
     */
    public function show(Article $article)
    {

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            //$category = $article->getCategory(), 

        ]);
    }

}
