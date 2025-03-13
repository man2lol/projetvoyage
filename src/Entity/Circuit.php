<?php
declare(strict_types=1);
namespace MyApp\Entity;

class Circuit
{
    private ?int $identifiantCircuit = null;
    private string $descriptif;
    private string $villeDepart;
    private string $paysDepart;
    private string $villeArrivee;
    private string $paysArrivee;
    private string $dateDepart;
    private int $nbrPlaceDisponible;
    private int $duree;
    private float $prixInscription;

    public function __construct(
        ?int $identifiantCircuit,
        string $descriptif,
        string $villeDepart,
        string $paysDepart,
        string $villeArrivee,
        string $paysArrivee,
        string $dateDepart,
        int $nbrPlaceDisponible,
        int $duree,
        float $prixInscription
    ) {
        $this->identifiantCircuit = $identifiantCircuit;
        $this->descriptif = $descriptif;
        $this->villeDepart = $villeDepart;
        $this->paysDepart = $paysDepart;
        $this->villeArrivee = $villeArrivee;
        $this->paysArrivee = $paysArrivee;
        $this->dateDepart = $dateDepart;
        $this->nbrPlaceDisponible = $nbrPlaceDisponible;
        $this->duree = $duree;
        $this->prixInscription = $prixInscription;
    }

    
    public function getIdentifiantCircuit(): ?int
    {
        return $this->identifiantCircuit;
    }

    public function setIdentifiantCircuit(?int $identifiantCircuit): void
    {
        $this->identifiantCircuit = $identifiantCircuit;
    }

    public function getDescriptif(): string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): void
    {
        $this->descriptif = $descriptif;
    }

    public function getVilleDepart(): string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(string $villeDepart): void
    {
        $this->villeDepart = $villeDepart;
    }

    public function getPaysDepart(): string
    {
        return $this->paysDepart;
    }

    public function setPaysDepart(string $paysDepart): void
    {
        $this->paysDepart = $paysDepart;
    }

    public function getVilleArrivee(): string
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(string $villeArrivee): void
    {
        $this->villeArrivee = $villeArrivee;
    }

    public function getPaysArrivee(): string
    {
        return $this->paysArrivee;
    }

    public function setPaysArrivee(string $paysArrivee): void
    {
        $this->paysArrivee = $paysArrivee;
    }

    public function getDateDepart(): string
    {
        return $this->dateDepart;
    }

    public function setDateDepart(string $dateDepart): void
    {
        $this->dateDepart = $dateDepart;
    }

    public function getNbrPlaceDisponible(): int
    {
        return $this->nbrPlaceDisponible;
    }

    public function setNbrPlaceDisponible(int $nbrPlaceDisponible): void
    {
        $this->nbrPlaceDisponible = $nbrPlaceDisponible;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
    }

    public function getPrixInscription(): float
    {
        return $this->prixInscription;
    }

    public function setPrixInscription(float $prixInscription): void
    {
        $this->prixInscription = $prixInscription;
    }
}


