<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Form\RestaurantFilterType;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RestaurantController extends AbstractController
{
   /**
     * @Route("/restaurant", name="restaurant", methods={"GET","POST"})
     */
    public function home(Request $request)
    {
        $restaurant = new Restaurant();
        $manager= $this->getDoctrine()->getManager();
        $form = $this->createForm(RestaurantFilterType::class, $restaurant);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $repo = $this->getDoctrine()->getRepository(Restaurant::class);
            $entityManager = $this->getDoctrine()->getManager();
            $restaurants = $repo->findAll();
          
        return $this->render('restaurant/home.html.twig', [
                'controller_name' => 'RestaurantController',
                'restaurants' => $restaurants,
                'form' => $form->createView(),
            ]);
        } else {
            $repo = $this->getDoctrine()->getRepository(Restaurant::class);
            $entityManager = $this->getDoctrine()->getManager();
            $restaurants = $repo->findAll();
            return $this->render('restaurant/home.html.twig', [
                'controller_name' => 'RestaurantController',
                'restaurants' => $restaurants,
                'form' => $form->createView(),
            ]);
        }
    }


 

    /**
     * @Route("/restaurant/{id}", name="restaurant_detail")
     */
    public function restaurant($id)
    {
        $repo = $this->getDoctrine()->getRepository(Restaurant::class);

        $restaurant = $repo->find($id);
        return $this->render('restaurant/detail.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }


    /**
     * @Route("/admin/restaurant", name="restaurant_index", methods={"GET"})
     */
    public function index(RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/account/restaurant/new", name="restaurant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $restaurant->setUser($this->getUser());
            $entityManager->persist($restaurant);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('restaurant/new.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/restaurant/{id}", name="restaurant_show", methods={"GET"})
     */
    public function show(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * @Route("admin/restaurant/{id}/edit", name="restaurant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Restaurant $restaurant): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('restaurant_index');
        }

        return $this->render('restaurant/edit.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/restaurant/{id}", name="restaurant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Restaurant $restaurant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($restaurant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('restaurant_index');
    }
}
