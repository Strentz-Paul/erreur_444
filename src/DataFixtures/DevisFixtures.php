<?php

namespace App\DataFixtures;

use App\Entity\Bilan;
use App\Entity\Devis;
use App\Enum\DevisStatutEnum;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DevisFixtures extends AbstractBaseFixtures implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < self::NUMBER_OF_DEVIS; $i++) {
            $devis = new Devis();
            $randomIndex = random_int(0, 4);
            $nameOfEnum = DevisStatutEnum::names();
            $tjm = random_int(350, 450);
            $nbJours = random_int(1, 240);
            $enumValue = $nameOfEnum[$randomIndex];
            /** @var Bilan $bilan */
            $bilan = $this->getReference(self::BILAN_REF);
            $isComplete = in_array($enumValue, array('SIGNE', 'REFUSE'));
            switch ($enumValue) {
                case $enumValue === 'PREPARATION':
                   $enum = DevisStatutEnum::PREPARATION;
                   break;
                case $enumValue === 'ENVOYE' :
                   $enum = DevisStatutEnum::ENVOYE;
                   break;
                case $enumValue === 'SIGNE' :
                   $enum = DevisStatutEnum::SIGNE;
                   break;
                case $enumValue === 'REFUSE' :
                   $enum = DevisStatutEnum::REFUSE;
                   break;
                case $enumValue === 'NEGOCIATION' :
                   $enum = DevisStatutEnum::NEGOCIATION;
                   break;
            }
            $devis->setStatut($enum)
                ->setBilan($bilan)
                ->setTjm($tjm)
                ->setNbJours($nbJours)
                ->setCompleted($isComplete);
            $manager->persist($devis);
            $manager->flush();
            $this->addReference(self::DEVIS_REF . $i, $devis);
        }
    }

    public function getDependencies()
    {
        return array(
            BilanFixtures::class
        );
    }

    public static function getGroups(): array
    {
        return array('compta');
    }
}
