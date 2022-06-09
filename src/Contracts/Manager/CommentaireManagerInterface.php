<?php

namespace App\Contracts\Manager;

use App\Entity\Commentaire;

interface CommentaireManagerInterface
{
    /**
     * @param Commentaire $commentaire
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Commentaire $commentaire, bool $flush = true): void;
}
