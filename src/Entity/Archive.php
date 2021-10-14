<?php

namespace App\Entity;

use App\Repository\ArchiveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArchiveRepository::class)
 */
class Archive
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom_lieu;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $etat_sortie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nom_site;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_debut_sortie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree_sortie;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_cloture_inscription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_inscription_max_sortie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description_sortie;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $url_photo_sortie;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom_organisateur;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email_organisateur;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $participant_inscrit = [];

    public function getSiteId(): ?int
    {
        return $this->site_id;
    }

    public function setSiteId(?int $site_id): self
    {
        $this->site_id = $site_id;

        return $this;
    }

    public function getNomLieu(): ?string
    {
        return $this->nom_lieu;
    }

    public function setNomLieu(?string $nom_lieu): self
    {
        $this->nom_lieu = $nom_lieu;

        return $this;
    }

    public function getEtatSortie(): ?string
    {
        return $this->etat_sortie;
    }

    public function setEtatSortie(?string $etat_sortie): self
    {
        $this->etat_sortie = $etat_sortie;

        return $this;
    }

    public function getNomSite(): ?string
    {
        return $this->nom_site;
    }

    public function setNomSite(?string $nom_site): self
    {
        $this->nom_site = $nom_site;

        return $this;
    }

    public function getDateDebutSortie(): ?\DateTimeInterface
    {
        return $this->date_debut_sortie;
    }

    public function setDateDebutSortie(?\DateTimeInterface $date_debut_sortie): self
    {
        $this->date_debut_sortie = $date_debut_sortie;

        return $this;
    }

    public function getDureeSortie(): ?int
    {
        return $this->duree_sortie;
    }

    public function setDureeSortie(?int $duree_sortie): self
    {
        $this->duree_sortie = $duree_sortie;

        return $this;
    }

    public function getDateClotureInscription(): ?\DateTimeInterface
    {
        return $this->date_cloture_inscription;
    }

    public function setDateClotureInscription(?\DateTimeInterface $date_cloture_inscription): self
    {
        $this->date_cloture_inscription = $date_cloture_inscription;

        return $this;
    }

    public function getNbInscriptionMaxSortie(): ?int
    {
        return $this->nb_inscription_max_sortie;
    }

    public function setNbInscriptionMaxSortie(?int $nb_inscription_max_sortie): self
    {
        $this->nb_inscription_max_sortie = $nb_inscription_max_sortie;

        return $this;
    }

    public function getDescriptionSortie(): ?string
    {
        return $this->description_sortie;
    }

    public function setDescriptionSortie(?string $description_sortie): self
    {
        $this->description_sortie = $description_sortie;

        return $this;
    }

    public function getUrlPhotoSortie(): ?string
    {
        return $this->url_photo_sortie;
    }

    public function setUrlPhotoSortie(?string $url_photo_sortie): self
    {
        $this->url_photo_sortie = $url_photo_sortie;

        return $this;
    }

    public function getNomOrganisateur(): ?string
    {
        return $this->nom_organisateur;
    }

    public function setNomOrganisateur(?string $nom_organisateur): self
    {
        $this->nom_organisateur = $nom_organisateur;

        return $this;
    }

    public function getEmailOrganisateur(): ?string
    {
        return $this->email_organisateur;
    }

    public function setEmailOrganisateur(?string $email_organisateur): self
    {
        $this->email_organisateur = $email_organisateur;

        return $this;
    }

    public function getParticipantInscrit(): ?array
    {
        return $this->participant_inscrit;
    }

    public function setParticipantInscrit(?array $participant_inscrit): self
    {
        $this->participant_inscrit = $participant_inscrit;

        return $this;
    }
}
