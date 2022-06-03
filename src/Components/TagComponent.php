<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('tag')]
class TagComponent
{
    public string $intitule;
    public string $color;
    public string $class;
}
