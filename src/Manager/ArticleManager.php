<?php

namespace App\Manager;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Entity\Article;
use App\Entity\Tag;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use App\ViewModel\ArticleVm;
use Doctrine\Common\Collections\Collection;
use LogicException;

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
        $vm = $this->articleRepo->getArticleVmBySlug($slug);
        if ($vm === null) {
            throw new InvalidArgumentException("Slug does not exist");
        }
        $tags = $this->articleRepo->findAllTagsByArticleId($vm->getId());
        $coms = $this->articleRepo->findAllCommentairesByArticleId($vm->getId());
        $vm->setTags($tags)
            ->setCommentaires($coms);
        return $vm;
    }

    /**
     * @inheritDoc
     */
    public function getArticlesByTag(Tag $tag): Collection
    {
        $articles = $tag->getArticle();
        $vms = new ArrayCollection();
        foreach ($articles as $article) {
            $vm = new ArticleVm(
                $article->getId(),
                true,
                $article->getSlug(),
                $article->getTitre(),
                $article->getCreatedAt(),
                $article->getContent(),
                (string)$article->getUser(),
                $article->getUser()?->getSlug()
            );
            $vms->add($vm);
        }
        return $this->addAssociativesEntityToArticleVm($vms);
    }

    /**
     * @inheritDoc
     */
    public function findOneBySlug(string $slug): Article
    {
        $article = $this->articleRepo->findOneBySlug($slug);
        if ($article === null) {
            throw new LogicException("There is no Article linked to this slug");
        }
        return $article;
    }

    /**
     * @inheritDoc
     */
    public function findAllCollection(): Collection
    {
        return $this->articleRepo->findAllCollection();
    }

    /**
     * @inheritDoc
     */
    public function findAllCollectionByTag(Tag $tag): Collection
    {
        $articles = $tag->getArticle();
        $aCollection = new ArrayCollection();
        foreach ($articles as $a) {
            $aCollection->add($a);
        }
        return $aCollection;
    }

    /**
     * @inheritDoc
     */
    public function findByQuery(string $querySearch): Collection
    {
        return $this->articleRepo->findByQuery($querySearch);
    }

    /**
     * @param Collection $vms
     * @return Collection
     */
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
