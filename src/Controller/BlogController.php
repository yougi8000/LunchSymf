<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleCategory;
use App\Repository\ArticleRepository;
use App\Repository\ArticleCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator



class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */


        public function index(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
        {
        //$repo = $this->getDoctrine()->getRepository(Article::class);

        //$articles = $repo->findAll();

            // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
            $donnees = $this->getDoctrine()->getRepository(Article::class)->findBy([],['createdAt' => 'desc']);
    
            $articles = $paginator->paginate(
                $donnees, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                4 // Nombre de résultats par page
            );
            
            //$articles->setCategory($category);   ManyToOne je ne sais pas si ça marche

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
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
