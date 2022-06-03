<?php

namespace App\Controller;

use App\Contracts\Manager\ArticleManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @param string $slug
     * @param ArticleManagerInterface $articleManager
     * @return Response
     */
    #[Route('/{slug}', name: 'article_index')]
    public function articleAction(
        string $slug,
        ArticleManagerInterface $articleManager
    ): Response {
        $article = $articleManager->getArticleVmBySlug($slug);
        return $this->render('article/index.html.twig', array(
            'article' => $article
        ));
    }
}
