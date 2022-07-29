<?php

namespace App\DataFixtures;

use App\Entity\Bilan;
use App\Entity\Devis;
use App\Entity\Mission;
use App\Entity\Paiement;
use App\Enum\DevisStatutEnum;
use App\Enum\PaiementTypeEnum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PaiementFixtures extends AbstractBaseFixtures implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
//        TODO recuperer le combre de paiment en fonction du TJM et du nombre de jours par mois
//        TODO Si la mission à 12 jours alors je fait 12 * tjm si la date de

        for ($i = 0; $i < self::NUMBER_OF_DEVIS; $i++) {
            /** @var Devis $devis */
            $devis = $this->getReference(self::DEVIS_REF . $i);
            if ($devis->getStatut() === DevisStatutEnum::SIGNE) {
                $nbJours = $devis->getNbJours();
                $tjm = $devis->getTjm();
                /** @var Bilan $bilan */
                $bilan = $this->getReference(self::BILAN_REF);
                /** @var Mission $mission */
                $mission = $devis->getMission();
                if ($mission->getEndDate() !== null) {
                    $paiement = new Paiement();
                    $paiement->setDate($mission->getEndDate())
                        ->setType(PaiementTypeEnum::ENTRANT)
                        ->setValeur($nbJours * $tjm)
                        ->addMission($mission)
                        ->addBilan($bilan);
                    $manager->persist($paiement);
                    $mission->addPaiement($paiement);
                    $manager->flush();
                    $this->addReference(self::PAIEMENT_REF . $i, $mission);
                }
            }
        }
        for ($i = 0; $i < self::NUMBER_OF_DEPENSE; $i++) {
            $valeur = random_int(10, 2925) + 0.99;
            $startDate = DateTime::createFromFormat('Y-m-d', '2022-01-01');
            $now = new DateTime();
            $date = $this->randomDateInRange($startDate,$now);
            $paiement = new Paiement();
            $paiement->setType(PaiementTypeEnum::SORTANT)
                ->setDate($date)
                ->setValeur($valeur);
            $manager->persist($paiement);
            $manager->flush();
            $this->addReference(self::PAIEMENT_SORTANT_REF . $i, $paiement);
        }
    }
    public function getDependencies()
    {
        return array(
            MissionFixtures::class,
            BilanFixtures::class
        );
    }

    public static function getGroups(): array
    {
        return array('compta');
    }

    private function randomDateInRange(DateTime $start, DateTime $end) {
        $randomTimestamp = random_int($start->getTimestamp(), $end->getTimestamp());
        $randomDate = new DateTime();
        $randomDate->setTimestamp($randomTimestamp);
        return $randomDate;
    }
}
