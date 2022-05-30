<?php

namespace App\Controller;

use App\Helper\ArticleHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
//        TODO implementer la liste de tous les articles du site en version short avec un composant ArticleComponent
        return $this->render('home/index.html.twig', [
        ]);
    }
}
