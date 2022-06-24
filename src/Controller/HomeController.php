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
     * @param Request $request
     * @param SiteMapServiceInterface $siteMapService
     * @return Response
     */
    #[Route('/sitemap.xml', name: 'sitemap', defaults: ['_format'=> 'html|xml'])]
    public function sitemapAction(
        Request $request,
        SiteMapServiceInterface $siteMapService,
    ): Response {
        $vm = $siteMapService->generateSiteMap($request);
        $response = new Response(
            $this->renderView('home/sitemap.html.twig', array(
                'vm' => $vm,
                'hostname' => $vm->getHostname()
            )), 200
        );
        $response->headers->set('Content-type', 'text/xml');
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/a-propos', name: 'a_propos')]
    public function aProposAtion(
        Request $request,
    ): Response {
       return $this->render('home/a-propos.html.twig');
    }
}
