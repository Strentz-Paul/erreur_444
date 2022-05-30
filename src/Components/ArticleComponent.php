<?php

namespace App\Components;

use App\Contracts\Components\ArticleComponentInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('article')]
class ArticleComponent implements ArticleComponentInterface
{
}
