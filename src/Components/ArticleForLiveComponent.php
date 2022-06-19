<?php

namespace App\Components;

use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('articles_for_live_component')]
class ArticleForLiveComponent
{
    public Collection $articles;
}
