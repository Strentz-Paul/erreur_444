<?php

namespace App\Dto;

use App\Entity\Article;
use Symfony\Component\Validator\Constraints as Assert;

class CommentaireDto
{
    /**
     * @Assert\NotBlank()
     */
    private string $username;
    /**
     * @Assert\NotBlank()
     */
    private string $content;
    private string $articleSlug;

    public function __construct(
        string $articleSlug
    ) {
        $this->articleSlug = $articleSlug;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return CommentaireDto
     */
    public function setUsername(string $username): CommentaireDto
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return CommentaireDto
     */
    public function setContent(string $content): CommentaireDto
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleSlug(): string
    {
        return $this->articleSlug;
    }
}
