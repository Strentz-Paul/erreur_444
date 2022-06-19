<?php

namespace App\Contracts\Manager;

use App\Entity\Article;
use App\Entity\Tag;
use App\ViewModel\ArticleVm;
use Doctrine\Common\Collections\Collection;

interface ArticleManagerInterface
{
    /**
     * @return Collection
     */
    public function getAllShortArticlesVms(): Collection;

    /**
     * @return Collection
     */
    public function getAllArticlesVms(): Collection;

    /**
     * @param string $slug
     * @return ArticleVm
     */
    public function getArticleVmBySlug(string $slug): ArticleVm;

    /**
     * @param Tag $tag
     * @return Collection
     */
    public function getArticlesByTag(Tag $tag): Collection;

    /**
     * @param string $slug
     * @return Article
     */
    public function findOneBySlug(string $slug): Article;

    /**
     * @return Collection
     */
    public function findAllCollection(): Collection;

    /**
     * @param Tag $tag
     * @return Collection
     */
    public function findAllCollectionByTag(Tag $tag): Collection;

    /**
     * @param string $querySearch
     * @return Collection
     */
    public function findByQuery(string $querySearch): Collection;
}
