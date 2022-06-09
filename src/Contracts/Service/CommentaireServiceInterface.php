<?php

namespace App\Contracts\Service;

use App\Dto\CommentaireDto;

interface CommentaireServiceInterface
{
    /**
     * @param CommentaireDto $dto
     * @return void
     */
    public function addCommentaireToArticle(CommentaireDto $dto): void;
}
