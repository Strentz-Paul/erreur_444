<?php

namespace App\Components;

use App\Contracts\Manager\UserManagerInterface;
use App\ViewModel\UserVm;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('author')]
class AuthorComponent
{
    public string $displayName;

    public function __construct(
        private UserManagerInterface $userManager
    ) {}

    /**
     * @return UserVm|null
     */
    public function getAuthor(): ?UserVm
    {
        return $this->userManager->findOneByDisplayName($this->displayName);
    }
}
