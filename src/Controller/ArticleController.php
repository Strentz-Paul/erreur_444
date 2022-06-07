<?php

namespace App\Controller;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Contracts\Manager\TagManagerInterface;
use App\Entity\Tag;
use InvalidArgumentException;
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

    #[Route('/tag/{slug}', name: 'article_filter_by_tag')]
    public function filterByTag(
        string $slug,
        TagManagerInterface $tagManager,
        ArticleManagerInterface $articleManager
    ): Response {
        $tag = $tagManager->findOneBySlug($slug);
        $articles = $articleManager->getArticlesByTag($tag);
        dd($articles);
        return $this->render('home/index.html.twig', array(
            'tag' => $tag,
            'articles' => $articles
        ));
    }
}
