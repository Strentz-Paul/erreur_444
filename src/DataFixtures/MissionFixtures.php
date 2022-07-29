<?php

namespace App\DataFixtures;

use App\Entity\Devis;
use App\Entity\Mission;
use App\Enum\DevisStatutEnum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MissionFixtures extends AbstractBaseFixtures implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::NUMBER_OF_DEVIS; $i++) {
            /** @var Devis $devis */
            $devis = $this->getReference(self::DEVIS_REF . $i);
            if ($devis->getStatut() === DevisStatutEnum::SIGNE) {
                $monthCount = random_int(1, 6);
                $startDate = new DateTime("-$monthCount month");
                $nbJours = $devis->getNbJours();
                $counTotalJours = $monthCount * 20;
                $endDate = (($counTotalJours - $nbJours) / 20) < 0 ? 1 : (int)($counTotalJours - $nbJours) / 20;
                $dateSentence = $endDate < 10 ? "2022-0$endDate-15" : "2022-$endDate-15";
                $endDate = DateTime::createFromFormat('Y-m-d', $dateSentence);
                if ($endDate !== false) {
                    $endDate = $endDate > (new DateTime()) ? null : $endDate;
                }
                $mission = new Mission();
                $mission->setTjm($devis->getTjm())
                    ->setStartDate($startDate)
                    ->setDevis($devis)
                    ->setEndDate($endDate === false ? null : $endDate);
                $manager->persist($mission);
                $manager->flush();
                $this->addReference(self::MISSION_REF . $i, $mission);
            }
        }
    }

    public function getDependencies()
    {
        return array(
            DevisFixtures::class
        );
    }

    public static function getGroups(): array
    {
        return array('compta');
    }
}
