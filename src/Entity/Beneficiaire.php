<?php
declare (strict_types = 1);
namespace MyApp\Entity;

class Beneficiaire
{
    private ?int $idBeneficiaire = null;
    private string $nom;
    private string $prenom;

    public function __construct(
        ?int $idBeneficiaire,
        string $nom,
        string $prenom
    ) {
        $this->idBeneficiaire = $idBeneficiaire;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getIdBeneficiaire(): ?int
    {
        return $this->idBeneficiaire;
    }

    public function setIdBeneficiaire(?int $idBeneficiaire): void
    {
        $this->idBeneficiaire = $idBeneficiaire;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }
}
