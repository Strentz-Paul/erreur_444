<?php

namespace App\Contracts\Service;

use App\ViewModel\SiteMapVM;
use Symfony\Component\HttpFoundation\Request;

interface SiteMapServiceInterface
{
    /**
     * @param Request $request
     * @return SiteMapVM
     */
    public function generateSiteMap(Request $request): SiteMapVM;
}
