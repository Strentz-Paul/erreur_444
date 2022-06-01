<?php

namespace App\Manager;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use App\ViewModel\ArticleVm;
use Doctrine\Common\Collections\Collection;

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

    /**
     * @inheritDoc
     */
    public function getAllArticlesVms(): Collection
    {
        $vms = $this->articleRepo->getAllArticlesVms();
        return $this->addAssociativesEntityToArticleVm($vms);
    }

    /**
     * @inheritDoc
     */
    public function getAllShortArticlesVms(): Collection
    {
        $vms = $this->articleRepo->getAllArticlesVms(true);
        return $this->addAssociativesEntityToArticleVm($vms);
    }

    /**
     * @inheritDoc
     */
    public function getArticleVmBySlug(string $slug): ArticleVm
    {
        return $this->articleRepo->getArticleVmBySlug($slug);
    }

    private function addAssociativesEntityToArticleVm(Collection $vms): Collection
    {
        $collectionVm = new ArrayCollection();
        /** @var ArticleVm $vm */
        foreach ($vms as $vm) {
            $tags = $this->articleRepo->findAllTagsByArticleId($vm->getId());
            $coms = $this->articleRepo->findAllCommentairesByArticleId($vm->getId());
            $vm->setTags($tags)
                ->setCommentaires($coms);
            $collectionVm->add($vm);
        }
        return $collectionVm;
    }
}
