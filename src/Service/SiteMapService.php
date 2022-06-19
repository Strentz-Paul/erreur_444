<?php

namespace App\Service;

use App\Contracts\Manager\ArticleManagerInterface;
use App\Contracts\Manager\TagManagerInterface;
use App\Contracts\Service\SiteMapServiceInterface;
use App\Entity\Article;
use App\Entity\Tag;
use App\ViewModel\SiteMapVM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SiteMapService implements SiteMapServiceInterface
{
    public function __construct(
        private UrlGeneratorInterface $router,
        private ArticleManagerInterface $articleManager,
        private TagManagerInterface $tagManager
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function generateSiteMap(Request $request): SiteMapVM
    {
        $articlesSlug = $this->articleManager->findAllCollection();
        $urlsArticleCollection = new ArrayCollection();
        /** @var Article $a */
        foreach ($articlesSlug as $a) {
            $url['url'] = $this->router->generate('article_index', array(
                'slug' => $a->getSlug()
            ));
            $url['createdAt'] = $a->getCreatedAt();
            $url['title'] = $a->getTitre();
            $url['content'] = $a->getContent();
            $url['author'] = $a->getUser();
            $urlsArticleCollection->add($url);
        }
        unset($articlesSlug);
        $tags = $this->tagManager->findAllCollection();
        $urlsTagCollection = new ArrayCollection();
        $urlsTagArticleCollection = new ArrayCollection();
        /** @var Tag $t */
        foreach ($tags as $t) {
            $url['url'] = $this->router->generate('article_filter_by_tag', array(
                "slug" => $t->getSlug()
            ));
            $url['intitule'] = $t->getIntitule();
            $urlsTagCollection->add($url);
            $articlesSlug = $this->articleManager->findAllCollectionByTag($t);
            /** @var Article $a */
            foreach ($articlesSlug as $a) {
                $urlArticleTag['url'] = $this->router->generate('article_with_tag', array(
                    'slug' => $a->getSlug(),
                    'slugTag' => $t->getSlug()
                ));
                $urlArticleTag['createdAt'] = $a->getCreatedAt();
                $urlArticleTag['title'] = $a->getTitre();
                $urlArticleTag['content'] = $a->getContent();
                $urlArticleTag['author'] = $a->getUser();
                $urlsTagArticleCollection->add($urlArticleTag);
            }
            unset($articlesSlug);
        }
        return new SiteMapVM(
            $urlsArticleCollection,
            $urlsTagCollection,
            $urlsTagArticleCollection,
            $request->getSchemeAndHttpHost()
        );
    }
}
