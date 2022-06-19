<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('feature')]
class FeatureComponent
{
    public string $titre;
    public string $description;
    public string $path;
}
