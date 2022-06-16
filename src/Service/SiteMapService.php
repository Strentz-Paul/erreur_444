<?php

namespace App\Service;

use App\Contracts\Service\SiteMapServiceInterface;
use App\ViewModel\SiteMapVM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SiteMapService implements SiteMapServiceInterface
{
    public function __construct(private UrlGeneratorInterface $router)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function generateSiteMap(Request $request): SiteMapVM
    {
        //TODO: Ici il faudra recuperer tous les slugs des articles et tous les slugs des tags liés a des articles et
        //TODO: et recomposer les urls
        $this->router->generate();
        return new SiteMapVM();
    }
}
