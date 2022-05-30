<?php

namespace App\ViewModel;

use App\Entity\User;
use App\Helper\ArticleHelper;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

final class ArticleVm
{
    private string $slug;
    private string $titre;
    private DateTimeInterface $createdAt;
    private string $content;
    private Collection $tags;
    private User $auteur;
    private Collection $commentaires;
    private bool $isShortContext = false;

    public function __construct(
        string $slug,
        string $titre,
        DateTimeInterface $createdAt,
        string $content,
        Collection $tags,
        User $auteur,
        Collection $commentaires,
        bool $isShortContext
    ) {
        $this->slug = $slug;
        $this->titre = $titre;
        $this->createdAt = $createdAt;
        $this->content = $isShortContext === false ? $this->convertToBionicReading($content) : $this->convertToShort($content);
        $this->tags = $tags;
        $this->auteur = $auteur;
        $this->commentaires = $commentaires;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @return User
     */
    public function getAuteur(): User
    {
        return $this->auteur;
    }

    /**
     * @return Collection
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    private function convertToBionicReading(string $content): string
    {
        return ArticleHelper::convertToBionicReadingContent($content);
    }

    private function convertToShort(string $content): string
    {
        $shorterArticle = ArticleHelper::convertToShort($content, 100);
        return ArticleHelper::convertToBionicReadingContent($shorterArticle, 3);
    }
}
