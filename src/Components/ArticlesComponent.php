<?php

namespace App\Components;

use App\Contracts\Components\ArticleComponentInterface;
use App\Contracts\Manager\ArticleManagerInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('articles')]
class ArticlesComponent implements ArticleComponentInterface
{
    public Collection $articles;

    public function __construct(
        private ArticleManagerInterface $articleManager
    ) {}

    public function getArticles() {
        return $this->articleManager->getAllShortArticlesVms();
    }
}
