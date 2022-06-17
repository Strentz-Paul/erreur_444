<?php

namespace App\ViewModel;

use Doctrine\Common\Collections\Collection;

final class SiteMapVM
{
    public function __construct(
        private Collection $urlsArticles,
        private Collection $urlsTags,
        private Collection $urlsTagsArticles,
        private string $hostname,
    ){}

    /**
     * @return Collection
     */
    public function getUrlsArticles(): Collection
    {
        return $this->urlsArticles;
    }

    /**
     * @return Collection
     */
    public function getUrlsTags(): Collection
    {
        return $this->urlsTags;
    }

    /**
     * @return Collection
     */
    public function getUrlsTagsArticles(): Collection
    {
        return $this->urlsTagsArticles;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }
}
