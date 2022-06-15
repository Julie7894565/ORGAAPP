<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentRepository::class)]
#[ApiResource]
class Instrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Materiel::class, inversedBy: 'instruments')]
    private $materiel;

    #[ORM\ManyToMany(targetEntity: Musicien::class, mappedBy: 'instrument')]
    private $musiciens;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
        $this->musiciens = new ArrayCollection();
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
     * @return Collection<int, Materiel>
     */
    public function getMateriel(): Collection
    {
        return $this->materiel;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiel->contains($materiel)) {
            $this->materiel[] = $materiel;
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        $this->materiel->removeElement($materiel);

        return $this;
    }

    /**
     * @return Collection<int, Musicien>
     */
    public function getMusiciens(): Collection
    {
        return $this->musiciens;
    }

    public function addMusicien(Musicien $musicien): self
    {
        if (!$this->musiciens->contains($musicien)) {
            $this->musiciens[] = $musicien;
            $musicien->addInstrument($this);
        }

        return $this;
    }

    public function removeMusicien(Musicien $musicien): self
    {
        if ($this->musiciens->removeElement($musicien)) {
            $musicien->removeInstrument($this);
        }

        return $this;
    }
}
