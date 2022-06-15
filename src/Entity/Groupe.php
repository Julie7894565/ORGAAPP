<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
#[ApiResource]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $contactName;

    #[ORM\Column(type: 'string', length: 255)]
    private $contactPhone;

    #[ORM\Column(type: 'string', length: 255)]
    private $contactEmail;

    #[ORM\Column(type: 'time')]
    private $setup;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'groupes')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Style::class, inversedBy: 'groupes')]
    #[ORM\JoinColumn(nullable: false)]
    private $style;

    #[ORM\ManyToMany(targetEntity: Musicien::class, mappedBy: 'groupe')]
    private $musiciens;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: GroupeEvenement::class)]
    private $evenement;

    public function __construct()
    {
        $this->musiciens = new ArrayCollection();
        $this->evenement = new ArrayCollection();
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

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): self
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(string $contactPhone): self
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    public function getContactEmail(): ?string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): self
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    public function getSetup(): ?\DateTimeInterface
    {
        return $this->setup;
    }

    public function setSetup(\DateTimeInterface $setup): self
    {
        $this->setup = $setup;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

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
            $musicien->addGroupe($this);
        }

        return $this;
    }

    public function removeMusicien(Musicien $musicien): self
    {
        if ($this->musiciens->removeElement($musicien)) {
            $musicien->removeGroupe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupeEvenement>
     */
    public function getEvenement(): Collection
    {
        return $this->evenement;
    }

    public function addEvenement(GroupeEvenement $evenement): self
    {
        if (!$this->evenement->contains($evenement)) {
            $this->evenement[] = $evenement;
            $evenement->setGroupe($this);
        }

        return $this;
    }

    public function removeEvenement(GroupeEvenement $evenement): self
    {
        if ($this->evenement->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getGroupe() === $this) {
                $evenement->setGroupe(null);
            }
        }

        return $this;
    }
}
