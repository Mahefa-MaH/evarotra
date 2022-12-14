<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\ManyToMany(targetEntity: Articles::class, mappedBy: 'Categories')]
    private Collection $categorie;

    #[ORM\Column(nullable: true)]
    private ?int $CategoryOrder = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(?Users $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Articles $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
            $categorie->addCategory($this);
        }

        return $this;
    }

    public function removeCategorie(Articles $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            $categorie->removeCategory($this);
        }

        return $this;
    }

    public function getCategoryOrder(): ?int
    {
        return $this->CategoryOrder;
    }

    public function setCategoryOrder(?int $CategoryOrder): self
    {
        $this->CategoryOrder = $CategoryOrder;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }
}
