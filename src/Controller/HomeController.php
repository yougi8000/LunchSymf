<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $category)
    {
        return $this->render('home/index.html.twig', [
            'categories' => $category->findAll(),
        ]);
    }
    /**
     * @Route("category/{id}", name="category_show")
     */
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}
