<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AjaxController extends AbstractController
{
    /**
     * @Route("/api/isLiked", name="api_isLiked")
     */
    public function setIsLiked() {
        return $this->json(['isLiked'=>'true']);
    }
   
}
