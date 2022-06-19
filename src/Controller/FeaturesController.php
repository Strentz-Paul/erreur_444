<?php

namespace App\Controller;

use App\Contracts\Service\FeaturesServiceInterface;
use App\Enum\FeaturesEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeaturesController extends AbstractController
{
    #[Route('/features', name: 'features_index')]
    public function featuresIndexAction(
    ): Response {
        return $this->render('features/index.html.twig');
    }

    #[Route('/features/live-component/', name: 'features_live_component')]
    public function featureLiveComponentAction(): Response
    {
        return $this->render('features/live-components.html.twig');
    }
}
