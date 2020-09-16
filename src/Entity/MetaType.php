<?php

namespace App\Entity;

use App\Repository\MetaTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetaTypeRepository::class)
 */
class MetaType
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
    private $lib_type_meta;

    /**
     * @ORM\OneToMany(targetEntity=Metas::class, mappedBy="metaType")
     */
    private $meta;

    public function __construct()
    {
        $this->meta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibTypeMeta(): ?string
    {
        return $this->lib_type_meta;
    }

    public function setLibTypeMeta(string $lib_type_meta): self
    {
        $this->lib_type_meta = $lib_type_meta;

        return $this;
    }

    /**
     * @return Collection|Metas[]
     */
    public function getMeta(): Collection
    {
        return $this->meta;
    }

    public function addMetum(Metas $metum): self
    {
        if (!$this->meta->contains($metum)) {
            $this->meta[] = $metum;
            $metum->setMetaType($this);
        }

        return $this;
    }

    public function removeMetum(Metas $metum): self
    {
        if ($this->meta->contains($metum)) {
            $this->meta->removeElement($metum);
            // set the owning side to null (unless already changed)
            if ($metum->getMetaType() === $this) {
                $metum->setMetaType(null);
            }
        }

        return $this;
    }
}
