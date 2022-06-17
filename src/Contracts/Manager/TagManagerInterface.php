<?php

namespace App\Contracts\Manager;

use App\Entity\Tag;
use Doctrine\Common\Collections\Collection;

interface TagManagerInterface
{
    /**
     * @param string $slug
     * @return Tag
     */
    public function findOneBySlug(string $slug): Tag;

    /**
     * @return Collection
     */
    public function findAllCollection(): Collection;
}
