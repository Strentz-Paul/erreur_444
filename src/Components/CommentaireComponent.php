<?php

namespace App\Components;

use App\Contracts\Manager\ArticleManagerInterface;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('commentaire')]
class CommentaireComponent
{
    public string $username;
    public string $content;
    public DateTimeImmutable $createdAt;
}
