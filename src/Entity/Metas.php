<?php

namespace App\Entity;

use App\Repository\MetasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetasRepository::class)
 */
class Metas
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
    private $mots_cles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=MetaPage::class, mappedBy="metas")
     */
    private $metapage;

    /**
     * @ORM\ManyToOne(targetEntity=MetaType::class, inversedBy="meta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $metaType;

    public function __construct()
    {
        $this->metapage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotsCles(): ?string
    {
        return $this->mots_cles;
    }

    public function setMotsCles(string $mots_cles): self
    {
        $this->mots_cles = $mots_cles;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $metapage->setMetas($this);
        }

        return $this;
    }

    public function removeMetapage(MetaPage $metapage): self
    {
        if ($this->metapage->contains($metapage)) {
            $this->metapage->removeElement($metapage);
            // set the owning side to null (unless already changed)
            if ($metapage->getMetas() === $this) {
                $metapage->setMetas(null);
            }
        }

        return $this;
    }

    public function getMetaType(): ?MetaType
    {
        return $this->metaType;
    }

    public function setMetaType(?MetaType $metaType): self
    {
        $this->metaType = $metaType;

        return $this;
    }
}
