<?php

namespace App\Controller\Admin\ComptaBook;


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
        $entreprises = $service->getAllEntreprises();
        return $this->render('admin/comptabook/index.html.twig', array(
            'entreprises' => $entreprises
        ));
    }
}
