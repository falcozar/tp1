<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
Use Gedmo\Mapping\Annotation as Gedmo;
Use symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=PagesRepository::class)
 * @Vich\Uploadable
 */
class Pages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=255)
     */
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10)
     */
    private $introduction;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10)
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $images;

    //ajout imageFile pour l'upload
    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="images")
     * @var File
     */
    private $imageFile;
    


    /**
     * @var \DateTime $created_at
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var \Datetime $updated_at
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="page")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Etats::class, inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etats;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Commentaires::class, mappedBy="pages")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=MetaPage::class, mappedBy="pages")
     */
    private $metapage;

    /**
     * @ORM\OneToMany(targetEntity=Menus::class, mappedBy="pages")
     */
    private $menus;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->metapage = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }


    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }


//ajout vich uploader
// Dans les Getters/setters
public function setImageFile(File $image = null)
{
    $this->imageFile = $image;

    if ($image) {
        $this->updated_at = new \DateTime('now');
    }
}

public function getImageFile()
{
    return $this->imageFile;
}


    // public function getImages(): ?string
    public function getImages()
    {
        return $this->images;
    }

    // public function setImages(?string $images): self
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }
/*
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }*/

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Commentaires[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setPages($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getPages() === $this) {
                $commentaire->setPages(null);
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
            $metapage->setPages($this);
        }

        return $this;
    }

    public function removeMetapage(MetaPage $metapage): self
    {
        if ($this->metapage->contains($metapage)) {
            $this->metapage->removeElement($metapage);
            // set the owning side to null (unless already changed)
            if ($metapage->getPages() === $this) {
                $metapage->setPages(null);
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
            $menu->setPages($this);
        }

        return $this;
    }

    public function removeMenu(Menus $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getPages() === $this) {
                $menu->setPages(null);
            }
        }

        return $this;
    }
}
