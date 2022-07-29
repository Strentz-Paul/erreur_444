<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;

abstract class AbstractBaseFixtures extends Fixture
{
    public const NUMBER_OF_ARTICLES = 24;
    public const NUMBER_MAX_OF_COMMENT = 10;
    public const NUMBER_OF_TAGS = 13;
    public const NUMBER_OF_ENTREPRISES = 5;
    public const NUMBER_OF_DEVIS = 12;
    public const NUMBER_OF_DEPENSE = 6;
    public const USER_REF = 'user';
    public const ARTICLE_REF = 'article_';
    public const COMMENT_REF = '_commentaire_';
    public const TAG_REF = 'tag_';
    public const ENTREPRISE_REF = 'entreprise_';
    public const PERSONNE_REF = 'personne_';
    public const BILAN_REF = 'bilan_';
    public const DEVIS_REF = 'bilan_';
    public const MISSION_REF = 'mission_';
    public const PAIEMENT_REF = 'paiement_';
    public const PAIEMENT_SORTANT_REF = 'paiement_sortant_';

    protected static function faker(): Generator
    {
        return Factory::create('fr_FR');
    }
}
