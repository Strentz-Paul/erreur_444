<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = self::faker();
        /** @var User $user */
        $user = $this->getReference(self::USER_REF);
        for ($i = 0; $i < self::NUMBER_OF_ARTICLES; $i++) {
            $article = new Article();
            $article->setTitre("Article #$i : " . $faker->word)
                ->setContent($faker->sentence(50, true))
                ->setCreatedAt(DateTimeImmutable::createFromMutable($faker->dateTime))
                ->setIsPublished(true)
                ->setUser($user);
            $manager->persist($article);
            $manager->flush();
            $this->addReference(self::ARTICLE_REF . $i, $article);
        }
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class
        );
    }
}
