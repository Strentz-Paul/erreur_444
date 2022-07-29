<?php

namespace App\DataFixtures;

use App\Entity\Bilan;
use App\Entity\Entreprise;
use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BilanFixtures extends AbstractBaseFixtures implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = self::faker();
        /** @var Entreprise $entreprise */
        $entreprise = $this->getReference(self::ENTREPRISE_REF . 1);
        $bilan = new Bilan();
        $bilan->setAnnee('2022')
            ->setEntreprise($entreprise);
        $manager->persist($bilan);
        $manager->flush();
        $this->addReference(self::BILAN_REF, $bilan);

    }

    public function getDependencies()
    {
        return array(
            EntrepriseFixtures::class
        );
    }

    public static function getGroups(): array
    {
        return array('compta');
    }
}
