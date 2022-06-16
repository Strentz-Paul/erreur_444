<?php

namespace App\Service;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Contracts\Manager\CommentaireManagerInterface;
use App\Contracts\Service\CommentaireServiceInterface;
use App\Dto\CommentaireDto;
use App\Entity\Article;
use App\Entity\Commentaire;
use DateTimeImmutable;

final class CommentaireService implements CommentaireServiceInterface
{
    private ArticleManagerInterface $articleManager;

    public function __construct(
        ArticleManagerInterface $articleManager,
        CommentaireManagerInterface $commentaireManager
    ) {
        $this->articleManager = $articleManager;
        $this->commentaireManager = $commentaireManager;
    }

    /**
     * {@inheritDoc}
     */
    public function addCommentaireToArticle(CommentaireDto $dto): void
    {
        $date = new DateTimeImmutable();
        /** @var Article $article */
        $article = $this->articleManager->findOneBySlug($dto->getArticleSlug());
        $commentaire = new Commentaire();
        $commentaire->setUsername($dto->getUsername())
            ->setCreatedAt($date)
            ->setContent($dto->getContent())
            ->setArticle($article);
        $this->commentaireManager->createOrUpdate($commentaire);
    }
}
