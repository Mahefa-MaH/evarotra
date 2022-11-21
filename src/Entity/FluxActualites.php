<?php

namespace App\Entity;

use App\Repository\FluxActualitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FluxActualitesRepository::class)]
class FluxActualites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'fluxActualites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $Users = null;

    #[ORM\OneToMany(mappedBy: 'fluxact', targetEntity: Commentaires::class)]
    private Collection $fluxcom;

    public function __construct()
    {
        $this->fluxcom = new ArrayCollection();
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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
     * @return Collection<int, Commentaires>
     */
    public function getFluxcom(): Collection
    {
        return $this->fluxcom;
    }

    public function addFluxcom(Commentaires $fluxcom): self
    {
        if (!$this->fluxcom->contains($fluxcom)) {
            $this->fluxcom->add($fluxcom);
            $fluxcom->setFluxact($this);
        }

        return $this;
    }

    public function removeFluxcom(Commentaires $fluxcom): self
    {
        if ($this->fluxcom->removeElement($fluxcom)) {
            // set the owning side to null (unless already changed)
            if ($fluxcom->getFluxact() === $this) {
                $fluxcom->setFluxact(null);
            }
        }

        return $this;
    }
}
