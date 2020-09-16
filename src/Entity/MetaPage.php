<?php

namespace App\Entity;

use App\Repository\MetaPageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetaPageRepository::class)
 */
class MetaPage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="metapage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Etats::class, inversedBy="metapage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etats;

    /**
     * @ORM\ManyToOne(targetEntity=Pages::class, inversedBy="metapage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pages;

    /**
     * @ORM\ManyToOne(targetEntity=Metas::class, inversedBy="metapage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $metas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getEtats(): ?Etats
    {
        return $this->etats;
    }

    public function setEtats(?Etats $etats): self
    {
        $this->etats = $etats;

        return $this;
    }

    public function getPages(): ?Pages
    {
        return $this->pages;
    }

    public function setPages(?Pages $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function getMetas(): ?Metas
    {
        return $this->metas;
    }

    public function setMetas(?Metas $metas): self
    {
        $this->metas = $metas;

        return $this;
    }
}
