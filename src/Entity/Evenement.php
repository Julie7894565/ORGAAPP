<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
#[ApiResource]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $nbDay;

    #[ORM\Column(type: 'array')]
    private $beginHour = [];

    #[ORM\Column(type: 'array')]
    private $endingHour = [];

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeName;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeLocation;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeContactName;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeContactPhoneNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private $placeContactEmail;

    #[ORM\Column(type: 'time')]
    private $balanceTime;

    #[ORM\Column(type: 'boolean')]
    private $indoor;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'evenements')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToMany(targetEntity: Materiel::class, mappedBy: 'evenement')]
    private $materiels;

    #[ORM\OneToMany(mappedBy: 'evenement', targetEntity: GroupeEvenement::class)]
    private $groupe;

    public function __construct()
    {
        $this->materiels = new ArrayCollection();
        $this->groupe = new ArrayCollection();
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

    public function getNbDay(): ?int
    {
        return $this->nbDay;
    }

    public function setNbDay(int $nbDay): self
    {
        $this->nbDay = $nbDay;

        return $this;
    }

    public function getBeginHour(): ?array
    {
        return $this->beginHour;
    }

    public function setBeginHour(array $beginHour): self
    {
        $this->beginHour = $beginHour;

        return $this;
    }

    public function getEndingHour(): ?array
    {
        return $this->endingHour;
    }

    public function setEndingHour(array $endingHour): self
    {
        $this->endingHour = $endingHour;

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

    public function getPlaceName(): ?string
    {
        return $this->placeName;
    }

    public function setPlaceName(string $placeName): self
    {
        $this->placeName = $placeName;

        return $this;
    }

    public function getPlaceLocation(): ?string
    {
        return $this->placeLocation;
    }

    public function setPlaceLocation(string $placeLocation): self
    {
        $this->placeLocation = $placeLocation;

        return $this;
    }

    public function getPlaceContactName(): ?string
    {
        return $this->placeContactName;
    }

    public function setPlaceContactName(string $placeContactName): self
    {
        $this->placeContactName = $placeContactName;

        return $this;
    }

    public function getPlaceContactPhoneNumber(): ?string
    {
        return $this->placeContactPhoneNumber;
    }

    public function setPlaceContactPhoneNumber(string $placeContactPhoneNumber): self
    {
        $this->placeContactPhoneNumber = $placeContactPhoneNumber;

        return $this;
    }

    public function getPlaceContactEmail(): ?string
    {
        return $this->placeContactEmail;
    }

    public function setPlaceContactEmail(string $placeContactEmail): self
    {
        $this->placeContactEmail = $placeContactEmail;

        return $this;
    }

    public function getBalanceTime(): ?\DateTimeInterface
    {
        return $this->balanceTime;
    }

    public function setBalanceTime(\DateTimeInterface $balanceTime): self
    {
        $this->balanceTime = $balanceTime;

        return $this;
    }

    public function isIndoor(): ?bool
    {
        return $this->indoor;
    }

    public function setIndoor(bool $indoor): self
    {
        $this->indoor = $indoor;

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

    /**
     * @return Collection<int, Materiel>
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->addEvenement($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            $materiel->removeEvenement($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupeEvenement>
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(GroupeEvenement $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
            $groupe->setEvenement($this);
        }

        return $this;
    }

    public function removeGroupe(GroupeEvenement $groupe): self
    {
        if ($this->groupe->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getEvenement() === $this) {
                $groupe->setEvenement(null);
            }
        }

        return $this;
    }
}
