<?php

namespace App\Contracts\Manager;

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
}
