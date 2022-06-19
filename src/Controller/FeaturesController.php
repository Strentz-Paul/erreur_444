<?php

namespace App\Controller;

use App\Enum\FeaturesEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeaturesController extends AbstractController
{
    #[Route('/features', name: 'features_index')]
    public function featuresIndexAction(
        FeaturesServiceInterface $featuresService
    ): Response
    {
        $values = FeaturesEnum::values();
        return $this->render('features/index.html.twig', array(
            'features' => $values
        ));
    }

    #[Route('/features/live-component/', name: 'features_live_component')]
    public function featureLiveComponentAction(): Response
    {
        return $this->render('features/live-components.html.twig');
    }
}
