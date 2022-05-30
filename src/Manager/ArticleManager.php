<?php

namespace App\Manager;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

final class ArticleManager implements ArticleManagerInterface
{
    private ArticleRepository $articleRepo;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $repo = $entityManager->getRepository(Article::class);
        if (!$repo instanceof ArticleRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Article::class,
                EntityManagerInterface::class,
                get_class($repo),
                Article::class
            ));
        }
        $this->articleRepo = $repo;
    }
}
