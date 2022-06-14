<?php

namespace App\Controller;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Contracts\Manager\TagManagerInterface;
use App\Contracts\Service\CommentaireServiceInterface;
use App\Dto\CommentaireDto;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @param Request $request
     * @param string $slug
     * @param ArticleManagerInterface $articleManager
     * @param CommentaireServiceInterface $commentaireService
     * @return Response
     */
    #[Route('/article/{slug}', name: 'article_index')]
    public function articleAction(
        Request $request,
        string $slug,
        ArticleManagerInterface $articleManager,
        CommentaireServiceInterface $commentaireService
    ): Response {
        $article = $articleManager->getArticleVmBySlug($slug);
        $dto = new CommentaireDto($article->getSlug());
        $commentaireForm = $this->createForm(CommentaireType::class, $dto);
        $commentaireForm->handleRequest($request);
        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $commentaireService->addCommentaireToArticle($dto);
            return $this->redirectToRoute('article_index', array(
                'slug' => $slug
            ));
        }
        return $this->render('article/index.html.twig', array(
            'article' => $article,
            'form' => $commentaireForm->createView()
        ));
    }

    /**
     * @param Request $request
     * @param string $slugTag
     * @param string $slug
     * @param ArticleManagerInterface $articleManager
     * @param TagManagerInterface $tagManager
     * @param CommentaireServiceInterface $commentaireService
     * @return Response
     */
    #[Route('/tag/{slugTag}/article/{slug}/', name: 'article_with_tag')]
    public function articleWithTagAction(
        Request $request,
        string $slugTag,
        string $slug,
        ArticleManagerInterface $articleManager,
        TagManagerInterface $tagManager,
        CommentaireServiceInterface $commentaireService
    ): Response {
        $article = $articleManager->getArticleVmBySlug($slug);
        $tag = $tagManager->findOneBySlug($slugTag);
        $dto = new CommentaireDto($article->getSlug());
        $commentaireForm = $this->createForm(CommentaireType::class, $dto);
        $commentaireForm->handleRequest($request);
        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $commentaireService->addCommentaireToArticle($dto);
            return $this->redirectToRoute('article_with_tag', array(
                'slug' => $slug,
                'slugTag' => $slugTag
            ));
        }
        return $this->render('article/index.html.twig', array(
            'article'   => $article,
            'tag'       => $tag,
            'form'      => $commentaireForm->createView()
        ));
    }

    /**
     * @param string $slug
     * @param TagManagerInterface $tagManager
     * @param ArticleManagerInterface $articleManager
     * @return Response
     */
    #[Route('/tag/{slug}', name: 'article_filter_by_tag')]
    public function filterByTag(
        string $slug,
        TagManagerInterface $tagManager,
        ArticleManagerInterface $articleManager
    ): Response {
        $tag = $tagManager->findOneBySlug($slug);
        $articles = $articleManager->getArticlesByTag($tag);
        return $this->render('article/filtered_by_tag.html.twig', array(
            'tag' => $tag,
            'articles' => $articles
        ));
    }
}
