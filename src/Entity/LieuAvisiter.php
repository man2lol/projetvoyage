<?php
declare(strict_types=1);
namespace MyApp\Entity;

class LieuAvisiter
{
    private string $nomLieu;
    private string $ville;
    private string $pays;
    private string $descriptif;
    private float $prixVisite;

    public function __construct(
        string $nomLieu,
        string $ville,
        string $pays,
        string $descriptif,
        float $prixVisite
    ) {
        $this->nomLieu = $nomLieu;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->descriptif = $descriptif;
        $this->prixVisite = $prixVisite;
    }

    
    public function getNomLieu(): string
    {
        return $this->nomLieu;
    }

    public function setNomLieu(string $nomLieu): void
    {
        $this->nomLieu = $nomLieu;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function getPays(): string
    {
        return $this->pays;
    }

    public function setPays(string $pays): void
    {
        $this->pays = $pays;
    }

    public function getDescriptif(): string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): void
    {
        $this->descriptif = $descriptif;
    }

    public function getPrixVisite(): float
    {
        return $this->prixVisite;
    }

    public function setPrixVisite(float $prixVisite): void
    {
        $this->prixVisite = $prixVisite;
    }
}
