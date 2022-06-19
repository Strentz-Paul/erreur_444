<?php

namespace App\Components;

use App\Contracts\Manager\ArticleManagerInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('article_search')]
class ArticleSearchLiveComponent
{
    use DefaultActionTrait;

    public string $query = '';

    public function __construct(
        private ArticleManagerInterface $articleManager
    ){}

    public function getArticles(): Collection
    {
        return $this->articleManager->findByQuery($this->query);
    }
}
