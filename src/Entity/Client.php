<?php
declare(strict_types=1);
namespace MyApp\Entity;

class Client
{
    private ?int $identifiantClient = null;
    private string $nom;
    private string $prenom;
    private string $dateNaissance;
    private string $identifiant;
    private string $password;

    public function __construct(
        ?int $identifiantClient,
        string $nom,
        string $prenom,
        string $dateNaissance,
        string $identifiant,
        string $password
    ) {
        $this->identifiantClient = $identifiantClient;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->identifiant = $identifiant;
        $this->password = $password;
    }

    public function getIdentifiantClient(): ?int
    {
        return $this->identifiantClient;
    }

    public function setIdentifiantClient(?int $identifiantClient): void
    {
        $this->identifiantClient = $identifiantClient;
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

    public function getDateNaissance(): string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(string $dateNaissance): void
    {
        $this->dateNaissance = $dateNaissance;
    }

    public function getIdentifiant(): string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): void
    {
        $this->identifiant = $identifiant;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
