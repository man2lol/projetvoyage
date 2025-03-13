<?php
declare(strict_types=1);
namespace MyApp\Entity;

class Administrateur
{
    private int $identifiantAdmin;
    private string $nom;
    private string $identifiant;
    private string $password;

    public function __construct(
        int $identifiantAdmin,
        string $nom,
        string $identifiant,
        string $password
    ) {
        $this->identifiantAdmin = $identifiantAdmin;
        $this->nom = $nom;
        $this->identifiant = $identifiant;
        $this->password = $password;
    }

   
    public function getIdentifiantAdmin(): int
    {
        return $this->identifiantAdmin;
    }

    public function setIdentifiantAdmin(int $identifiantAdmin): void
    {
        $this->identifiantAdmin = $identifiantAdmin;
    }

   
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
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
