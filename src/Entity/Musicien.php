<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MusicienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicienRepository::class)]
#[ApiResource]
class Musicien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Groupe::class, inversedBy: 'musiciens')]
    private $groupe;

    #[ORM\ManyToMany(targetEntity: Instrument::class, inversedBy: 'musiciens')]
    private $instrument;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
        $this->instrument = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        $this->groupe->removeElement($groupe);

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstrument(): Collection
    {
        return $this->instrument;
    }

    public function addInstrument(Instrument $instrument): self
    {
        if (!$this->instrument->contains($instrument)) {
            $this->instrument[] = $instrument;
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): self
    {
        $this->instrument->removeElement($instrument);

        return $this;
    }
}
