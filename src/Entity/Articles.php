<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Composition = null;

    #[ORM\Column(length: 255)]
    private ?string $Taille = null;

    #[ORM\Column]
    private ?int $Prix = null;

    #[ORM\Column]
    private ?bool $en_vente = null;

    #[ORM\Column(length: 255)]
    private ?string $Origine = null;

    #[ORM\Column(length: 255)]
    private ?string $Etat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $File = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $Users = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'categorie')]
    private Collection $Categories;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Commentaires::class)]
    private Collection $artcom;

    #[ORM\Column(nullable: true)]
    private ?int $quantite = null;

    public function __construct()
    {
        $this->Categories = new ArrayCollection();
        $this->artcom = new ArrayCollection();
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

    public function getComposition(): ?string
    {
        return $this->Composition;
    }

    public function setComposition(?string $Composition): self
    {
        $this->Composition = $Composition;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->Taille;
    }

    public function setTaille(string $Taille): self
    {
        $this->Taille = $Taille;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function isEnVente(): ?bool
    {
        return $this->en_vente;
    }

    public function setEnVente(bool $en_vente): self
    {
        $this->en_vente = $en_vente;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->Origine;
    }

    public function setOrigine(string $Origine): self
    {
        $this->Origine = $Origine;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

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

    public function getFile(): ?string
    {
        return $this->File;
    }

    public function setFile(string $File): self
    {
        $this->File = $File;

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
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->Categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->Categories->contains($category)) {
            $this->Categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->Categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getArtcom(): Collection
    {
        return $this->artcom;
    }

    public function addArtcom(Commentaires $artcom): self
    {
        if (!$this->artcom->contains($artcom)) {
            $this->artcom->add($artcom);
            $artcom->setArticle($this);
        }

        return $this;
    }

    public function removeArtcom(Commentaires $artcom): self
    {
        if ($this->artcom->removeElement($artcom)) {
            // set the owning side to null (unless already changed)
            if ($artcom->getArticle() === $this) {
                $artcom->setArticle(null);
            }
        }

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
    
}
