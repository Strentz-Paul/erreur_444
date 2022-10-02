<?php

namespace App\Controller\Admin\ComptaBook;


use App\Contracts\Manager\EntrepriseManagerInterface;
use App\Contracts\Service\ComptabiliteServiceInterface;
use App\Dto\DevisDto;
use App\Dto\EntrepriseDto;
use App\Dto\SimulateurDto;
use App\Entity\Entreprise;
use App\Enum\DevisStatutEnum;
use App\Form\DevisType;
use App\Form\EntrepriseType;
use App\Form\SimulateurType;
use App\Service\ComptabiliteService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        Request $request,
        EntrepriseManagerInterface $manager
    ): Response {
        $dto = new EntrepriseDto();
        $dateCreation = new DateTime();
        $dto->setDateDebut($dateCreation);
        $form = $this->createForm(EntrepriseType::class, $dto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entreprise = $manager->createEntrepriseByDto($dto);
            return $this->redirectToRoute('admin_comptabilite_entreprise_show', array(
                'entreprise' => $entreprise->getId()
            ));
        }
        return $this->render('admin/comptabook/entreprise--create.html.twig',
        array(
            'form' => $form->createView()
        ));
    }

    #[Route('/entreprise/{entreprise}', name: 'entreprise_show')]
    public function EntrepriseShowAction(
        Request $request,
       Entreprise $entreprise
    ): Response {
        return $this->render('admin/comptabook/entreprise--show.html.twig', array(
            'entreprise' => $entreprise
        ));
    }

    #[Route('/simulateur', name: 'simulateur')]
    public function simulateurAction(
        Request $request,
        ComptabiliteServiceInterface $service,
        ValidatorInterface $validator
    ): Response {
        $dtoSimulateur = new SimulateurDto();
        $formCalcul = $this->createForm(SimulateurType::class, $dtoSimulateur);
        $isValid = false;
        $formCalcul->handleRequest($request);
        $vmSimulateur = null;
        if ($formCalcul->isSubmitted() && $formCalcul->isValid()) {
            $isValid = $validator->validate($dtoSimulateur)->count() === 0;
            $vmSimulateur = $service->calculSalaireByDto($dtoSimulateur);
        }
        return $this->render('admin/comptabook/simulateur/index.html.twig', array(
            'vm' => $vmSimulateur,
            'form' => $formCalcul->createView(),
            'is_valid' => $isValid
        ));
    }

    #[Route('/{entreprise}/devis/create', name: 'devis_create')]
    public function createDevisAction(
        Request $request,
        Entreprise $entreprise
    ): Response {
        $devisDto = new DevisDto();
        $devisDto->setEntreprise($entreprise);
        $devisForm = $this->createForm(DevisType::class, $devisDto);
        $devisForm->handleRequest($request);
        if ($devisForm->isSubmitted() && $devisForm->isValid()) {

        }
        return $this->render('admin/comptabook/devis--create.html.twig', array(
            'devis_form' => $devisForm->createView(),
        ));
    }
}
