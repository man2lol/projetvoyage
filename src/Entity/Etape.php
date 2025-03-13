<?php
declare(strict_types=1);
namespace MyApp\Entity;

use MyApp\Entity\Circuit;
use MyApp\Entity\LieuAvisiter;

class Etape
{
    private int $identifiantCircuit; 
    private int $ordre;
    private string $dateEtape;
    private int $duree;
    private string $nomLieu;
    private string $ville;
    private string $pays;

    
    private Circuit $circuit; 
    private LieuAvisiter $lieuAvisiter; 

    public function __construct(
        int $identifiantCircuit,
        int $ordre,
        string $dateEtape,
        int $duree,
        string $nomLieu,
        string $ville,
        string $pays,
        Circuit $circuit,
        LieuAvisiter $lieuAvisiter
    ) {
        $this->identifiantCircuit = $identifiantCircuit;
        $this->ordre = $ordre;
        $this->dateEtape = $dateEtape;
        $this->duree = $duree;
        $this->nomLieu = $nomLieu;
        $this->ville = $ville;
        $this->pays = $pays;
        $this->circuit = $circuit;
        $this->lieuAvisiter = $lieuAvisiter;
    }

    
    public function getIdentifiantCircuit(): int
    {
        return $this->identifiantCircuit;
    }

    public function setIdentifiantCircuit(int $identifiantCircuit): void
    {
        $this->identifiantCircuit = $identifiantCircuit;
    }

   
    public function getOrdre(): int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): void
    {
        $this->ordre = $ordre;
    }

   
    public function getDateEtape(): string
    {
        return $this->dateEtape;
    }

    public function setDateEtape(string $dateEtape): void
    {
        $this->dateEtape = $dateEtape;
    }

    
    public function getDuree(): int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
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

   
    public function getCircuit(): Circuit
    {
        return $this->circuit;
    }

    public function setCircuit(Circuit $circuit): void
    {
        $this->circuit = $circuit;
    }

   
    public function getLieuAvisiter(): LieuAvisiter
    {
        return $this->lieuAvisiter;
    }

    public function setLieuAvisiter(LieuAvisiter $lieuAvisiter): void
    {
        $this->lieuAvisiter = $lieuAvisiter;
    }
}

