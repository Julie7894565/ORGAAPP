<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeEvenementRepository::class)]
#[ApiResource]
class GroupeEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Groupe::class, inversedBy: 'evenement')]
    #[ORM\JoinColumn(nullable: false)]
    private $groupe;

    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: 'groupe')]
    #[ORM\JoinColumn(nullable: false)]
    private $evenement;

    #[ORM\Column(type: 'integer')]
    private $day;

    #[ORM\Column(type: 'time')]
    private $tduration;

    #[ORM\Column(type: 'integer')]
    private $runningOrder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getTduration(): ?\DateTimeInterface
    {
        return $this->tduration;
    }

    public function setTduration(\DateTimeInterface $tduration): self
    {
        $this->tduration = $tduration;

        return $this;
    }

    public function getRunningOrder(): ?int
    {
        return $this->runningOrder;
    }

    public function setRunningOrder(int $runningOrder): self
    {
        $this->runningOrder = $runningOrder;

        return $this;
    }
}
