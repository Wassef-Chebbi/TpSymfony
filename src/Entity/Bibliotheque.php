<?php

namespace App\Entity;

use App\Repository\BibliothequeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BibliothequeRepository::class)]
class Bibliotheque 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $domaine = null;

    #[ORM\Column]
    private ?int $nbetage = null;

    #[ORM\Column]
    private ?int $nbrayon = null;

    #[ORM\OneToMany(mappedBy: 'bibliotheque', targetEntity: Livre::class)]
    private Collection $Livre;

    public function __construct()
    {
        $this->Livre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?int
    {
        return $this->libelle;
    }

    public function setLibelle(int $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getNbetage(): ?int
    {
        return $this->nbetage;
    }

    public function setNbetage(int $nbetage): self
    {
        $this->nbetage = $nbetage;

        return $this;
    }

    public function getNbrayon(): ?int
    {
        return $this->nbrayon;
    }

    public function setNbrayon(int $nbrayon): self
    {
        $this->nbrayon = $nbrayon;

        return $this;
    }
    

    /**
     * @return Collection<int, Livre>
     */
    public function getLivre(): Collection
    {
        return $this->Livre;
    }
    public function __toString(){
        return $this->libelle;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->Livre->contains($livre)) {
            $this->Livre->add($livre);
            $livre->setBibliotheque($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->Livre->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getBibliotheque() === $this) {
                $livre->setBibliotheque(null);
            }
        }

        return $this;
    }
}
