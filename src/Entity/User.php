<?php
declare (strict_types = 1);
namespace MyApp\Entity;

class User
{
    private ?int $id = null;
    private string $nom;
    private string $prenom;
    private string $date_de_naissance;
    private string $rue;
    private string $ville;
    private string $code_postal;
    private string $tel;
    private string $email;
    public function __construct(?int $id, string $nom, string $prenom,string $date_de_naissance, string $rue , string $ville , string $code_postal,string $tel ,string $email)

    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_de_naissance = $date_de_naissance;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->code_postal = $code_postal;
        $this->tel = $tel;
        $this->email = $email;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
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

   
    public function getDateDeNaissance(): string
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(string $date_de_naissance): void
    {
        $this->date_de_naissance = $date_de_naissance;
    }

   
    public function getRue(): string
    {
        return $this->rue;
    }

    public function setRue(string $rue): void
    {
        $this->rue = $rue;
    }

    
    public function getVille(): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): string
    {
        return $this->ville;
    }
   
   
    public function getCodePostal(): string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): void
    {
        $this->code_postal = $code_postal;
    }

   
    public function getTel(): string
    {
        return $this->tel;
    }

    public function setTel(string $tel): void
    {
        $this->tel = $tel;
    }

    
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
