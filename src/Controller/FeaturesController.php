<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeaturesController extends AbstractController
{
    #[Route('/features/index', name: 'features--live_component')]
    public function featuresIndexAction(): Response
    {
        // TODO : ici il faudra creer un enum de php 8.1 pour pouvoir afficher les features
        return $this->render('features/index.html.twig');
    }

    #[Route('/features/live-component/', name: 'features--live_component')]
    public function featureLiveComponentAction(): Response
    {
        return $this->render('features/live-components.html.twig');
    }
}
