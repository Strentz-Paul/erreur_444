<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PersonneFixtures extends AbstractBaseFixtures implements FixtureGroupInterface, DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = self::faker();
        for ($i = 1; $i < self::NUMBER_OF_ENTREPRISES; $i++) {
            /** @var Entreprise $entreprise */
            $entreprise = $this->getReference(self::ENTREPRISE_REF . $i);
            $personne = new Personne();
            $personne->setNom($faker->name)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)
                ->setTelephone($faker->phoneNumber)
                ->addEntreprise($entreprise);
            $manager->persist($personne);
            $manager->flush();
            $this->addReference(self::PERSONNE_REF . $i, $personne);
        }
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
