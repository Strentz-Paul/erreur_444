<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/auteur/{slug}', name: 'author_description')]
    public function authorDisplayAction(
        string $slug
    ): Response{
        return $this->render('author/index.html.twig', array(
            'slug' => $slug
        ));
    }
}
