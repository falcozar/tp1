<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="L'adresse e-mail existe déjà !")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *  @Assert\Email( 
     * message = "L'adresse  '{{ value }}' est invalide.", 
     * checkMX = true 
     * ) 
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom_user;

    /**
     * @ORM\OneToMany(targetEntity=Pages::class, mappedBy="users")
     */
    private $page;

    /**
     * @ORM\OneToMany(targetEntity=Menus::class, mappedBy="users")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity=Categories::class, mappedBy="users")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=MetaPage::class, mappedBy="users")
     */
    private $metapage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    public function __construct()
    {
        $this->page = new ArrayCollection();
        $this->menus = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->metapage = new ArrayCollection();
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }

    public function setNomUser(string $nom_user): self
    {
        $this->nom_user = $nom_user;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenom_user;
    }

    public function setPrenomUser(?string $prenom_user): self
    {
        $this->prenom_user = $prenom_user;

        return $this;
    }

    /**
     * @return Collection|Pages[]
     */
    public function getPage(): Collection
    {
        return $this->page;
    }

    public function addPage(Pages $page): self
    {
        if (!$this->page->contains($page)) {
            $this->page[] = $page;
            $page->setUsers($this);
        }

        return $this;
    }

    public function removePage(Pages $page): self
    {
        if ($this->page->contains($page)) {
            $this->page->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getUsers() === $this) {
                $page->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Menus[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menus $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setUsers($this);
        }

        return $this;
    }

    public function removeMenu(Menus $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getUsers() === $this) {
                $menu->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->setUsers($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getUsers() === $this) {
                $category->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MetaPage[]
     */
    public function getMetapage(): Collection
    {
        return $this->metapage;
    }

    public function addMetapage(MetaPage $metapage): self
    {
        if (!$this->metapage->contains($metapage)) {
            $this->metapage[] = $metapage;
            $metapage->setUsers($this);
        }

        return $this;
    }

    public function removeMetapage(MetaPage $metapage): self
    {
        if ($this->metapage->contains($metapage)) {
            $this->metapage->removeElement($metapage);
            // set the owning side to null (unless already changed)
            if ($metapage->getUsers() === $this) {
                $metapage->setUsers(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

          /**
     * Transform to string
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNomUser();
    }
}
