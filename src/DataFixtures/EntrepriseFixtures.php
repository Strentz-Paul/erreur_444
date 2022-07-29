<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Enum\StatutJuridiqueEnum;
use DateTime;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class EntrepriseFixtures extends AbstractBaseFixtures implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = self::faker();
        for ($i = 0; $i < self::NUMBER_OF_ENTREPRISES; $i++) {
            $isNull = random_int(0, 1);
            $entreprise = new Entreprise();
            $entreprise->setNom($faker->word)
                ->setDateDebut($i === 0 ? DateTime::createFromFormat('Y-m-d', '2022-01-01') : $faker->dateTime)
                ->setDateFin($isNull === 0 ? $faker->dateTime : null)
                ->setIsExterne($i !== 0)
                ->setStatutJuridique(
                    $i === 0 ? StatutJuridiqueEnum::MICRO_ENTREPRISE : StatutJuridiqueEnum::UNDEFINED
                );
            $manager->persist($entreprise);
            $manager->flush();
            $this->addReference(self::ENTREPRISE_REF . $i, $entreprise);
        }
    }
    public static function getGroups(): array
    {
        return array('compta');
    }
}
