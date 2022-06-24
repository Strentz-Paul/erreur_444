<?php

namespace App\ViewModel;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;

final class UserVm
{
    private string $displayName;
    private string $email;
    private string $description;
    private Collection $articles;
    private ?string $linkedinPath;
    private ?string $twitterPath;
    private ?string $githubPath;

    public function __construct(
        User $user
    ){
        $this->displayName = $user->getDisplayName();
        $this->email = $user->getEmail();
        $this->description = $user->getDescription();
        $this->articles = $user->getArticles();
        $this->linkedinPath = $user->getLinkedinProfilLink();
        $this->twitterPath = $user->getTwitterProfilLink();
        $this->githubPath = $user->getGithubProfilLink();
    }

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param string|null $displayName
     * @return UserVm
     */
    public function setDisplayName(?string $displayName): UserVm
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return UserVm
     */
    public function setEmail(?string $email): UserVm
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getDescription(): mixed
    {
        return $this->description;
    }

    /**
     * @param mixed|string $description
     * @return UserVm
     */
    public function setDescription(mixed $description): UserVm
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @param Collection $articles
     * @return UserVm
     */
    public function setArticles(Collection $articles): UserVm
    {
        $this->articles = $articles;
        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getLinkedinPath(): mixed
    {
        return $this->linkedinPath;
    }

    /**
     * @param mixed|string|null $linkedinPath
     * @return UserVm
     */
    public function setLinkedinPath(mixed $linkedinPath): UserVm
    {
        $this->linkedinPath = $linkedinPath;
        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getTwitterPath(): mixed
    {
        return $this->twitterPath;
    }

    /**
     * @param mixed|string|null $twitterPath
     * @return UserVm
     */
    public function setTwitterPath(mixed $twitterPath): UserVm
    {
        $this->twitterPath = $twitterPath;
        return $this;
    }

    /**
     * @return mixed|string|null
     */
    public function getGithubPath(): mixed
    {
        return $this->githubPath;
    }

    /**
     * @param mixed|string|null $githubPath
     * @return UserVm
     */
    public function setGithubPath(mixed $githubPath): UserVm
    {
        $this->githubPath = $githubPath;
        return $this;
    }
}
