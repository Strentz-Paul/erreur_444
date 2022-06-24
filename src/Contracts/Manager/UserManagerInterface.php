<?php

namespace App\Contracts\Manager;

use App\Entity\User;
use App\ViewModel\UserVm;

interface UserManagerInterface
{
    /**
     * @param User $user
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(User $user, bool $flush = true): void;

    /**
     * @param string $displayName
     * @return User|null
     */
    public function findOneByDisplayName(string $displayName): ?UserVM;
}
