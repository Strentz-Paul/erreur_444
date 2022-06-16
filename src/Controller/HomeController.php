<?php

namespace App\Controller;

use App\Contracts\Service\SiteMapServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @return Response
     */
    #[Route('/sitemap.xml', name: 'sitemap', defaults: ['_format'=> 'html|xml'])]
    public function sitemapAction(
        Request $request,
        SiteMapServiceInterface $siteMapService,
    ): Response {
        $siteMapService->generateSiteMap($request);


        return $this->render('home/sitemap.html.twig');
    }
}
