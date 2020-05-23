<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRestaurantRepository;
use App\Entity\CategoryRestaurant;
use Symfony\Component\HttpFoundation\Response;

class CategoryRestaurantController extends AbstractController
{
    /**
     * @Route("/category", name="category_restaurant")
     */
    public function index(CategoryRestaurantRepository $category )
    {

        return $this->render('category_restaurant/index.html.twig', [
            'categoriesRestaurant' => $category->findAll(),
        ]);
    }

    /**
     * @Route("category/{id}", name="category_restaurant_show")
     */
    public function show(CategoryRestaurant $category): Response
    {
        return $this->render('category_restaurant/show.html.twig', [
            'category' => $category,
        ]);
    }
}
