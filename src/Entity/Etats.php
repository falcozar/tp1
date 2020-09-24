<?php

namespace App\Entity;

use App\Repository\EtatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatsRepository::class)
 */
class Etats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lib_etat;

    /**
     * @ORM\OneToMany(targetEntity=Menus::class, mappedBy="etats")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity=Categories::class, mappedBy="etats")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Pages::class, mappedBy="etats")
     */
    private $pages;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="etats")
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=MetaPage::class, mappedBy="etats")
     */
    private $metapage;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->pages = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
        $this->metapage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibEtat(): ?string
    {
        return $this->lib_etat;
    }

    public function setLibEtat(string $lib_etat): self
    {
        $this->lib_etat = $lib_etat;

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
            $menu->setEtats($this);
        }

        return $this;
    }

    public function removeMenu(Menus $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getEtats() === $this) {
                $menu->setEtats(null);
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
            $category->setEtats($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getEtats() === $this) {
                $category->setEtats(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pages[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Pages $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setEtats($this);
        }

        return $this;
    }

    public function removePage(Pages $page): self
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getEtats() === $this) {
                $page->setEtats(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire[] = $commentaire;
            $commentaire->setEtats($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaire->contains($commentaire)) {
            $this->commentaire->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getEtats() === $this) {
                $commentaire->setEtats(null);
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
            $metapage->setEtats($this);
        }

        return $this;
    }

    public function removeMetapage(MetaPage $metapage): self
    {
        if ($this->metapage->contains($metapage)) {
            $this->metapage->removeElement($metapage);
            // set the owning side to null (unless already changed)
            if ($metapage->getEtats() === $this) {
                $metapage->setEtats(null);
            }
        }

        return $this;
    }

        /**
     * Transform to string
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getLibEtat();
    }
}
