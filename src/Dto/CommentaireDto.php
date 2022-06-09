<?php

namespace App\Dto;

class CommentaireDto
{
    private string $username;
    private string $content;

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
}
