<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 30)]
    private $displayName;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Article::class)]
    private $articles;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', nullable: true)]
    private $linkedinProfilLink;

    #[ORM\Column(type: 'string', nullable: true)]
    private $twitterProfilLink;

    #[ORM\Column(type: 'string', nullable: true)]
    private $githubProfilLink;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $slug;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->displayName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLinkedinProfilLink()
    {
        return $this->linkedinProfilLink;
    }

    /**
     * @param mixed $linkedinProfilLink
     * @return User
     */
    public function setLinkedinProfilLink($linkedinProfilLink)
    {
        $this->linkedinProfilLink = $linkedinProfilLink;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTwitterProfilLink()
    {
        return $this->twitterProfilLink;
    }

    /**
     * @param mixed $twitterProfilLink
     * @return User
     */
    public function setTwitterProfilLink($twitterProfilLink)
    {
        $this->twitterProfilLink = $twitterProfilLink;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGithubProfilLink()
    {
        return $this->githubProfilLink;
    }

    /**
     * @param mixed $githubProfilLink
     * @return User
     */
    public function setGithubProfilLink($githubProfilLink)
    {
        $this->githubProfilLink = $githubProfilLink;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
}
