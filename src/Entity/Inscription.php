<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\ManyToOne(targetEntity=Sortie::class, inversedBy="inscriptions")
     */
    private $sortieId;

    /**
     * @ORM\ManyToOne(targetEntity=participant::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participantId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getSortieId(): ?Sortie
    {
        return $this->sortieId;
    }

    public function setSortieId(?Sortie $sortieId): self
    {
        $this->sortieId = $sortieId;

        return $this;
    }

    public function getParticipantId(): ?participant
    {
        return $this->participantId;
    }

    public function setParticipantId(?participant $participantId): self
    {
        $this->participantId = $participantId;

        return $this;
    }
}
