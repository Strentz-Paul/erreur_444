<?php

namespace App\Controller\Admin\ComptaBook;


use App\Dto\EntrepriseDto;
use App\Form\EntrepriseType;
use App\Service\ComptabiliteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/comptabilite', name: 'admin_comptabilite_')]
class ComptaBookController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function indexAction(
        Request $request,
        ComptabiliteService $service
    ): Response {
        $showExternal = (bool)$request->query->get('show-external', false);
        $entreprises = $service->getAllEntreprises($showExternal);
        return $this->render('admin/comptabook/index.html.twig', array(
            'entreprises' => $entreprises,
            'is_external_context' => $showExternal
        ));
    }

    #[Route('/entreprise-create', name: 'entreprise_create')]
    public function createEntrepriseAction(
        Request $request
    ): Response {
        $dto = new EntrepriseDto();
        $form = $this->createForm(EntrepriseType::class, $dto);
        $form->handleRequest($request);
        return $this->render('admin/comptabook/entreprise--create.html.twig',
        array(
            'form' => $form->createView()
        ));
    }
}
