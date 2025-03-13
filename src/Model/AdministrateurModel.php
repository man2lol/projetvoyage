<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\Administrateur;
use PDO;

class AdministrateurModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllAdministrateurs(): array
    {
        $sql = "SELECT * FROM Administrateur";
        $stmt = $this->db->query($sql);
        $administrateurs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $administrateurs[] = new Administrateur($row['idAdministrateur'], $row['nom'], $row['prenom'], $row['email'], $row['motDePasse']);
        }
        return $administrateurs;
    }

    public function getOneAdministrateur(int $id): ?Administrateur
    {
        $sql = "SELECT * FROM Administrateur WHERE idAdministrateur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Administrateur($row['idAdministrateur'], $row['nom'], $row['prenom'], $row['email'], $row['motDePasse']);
    }

    public function createAdministrateur(Administrateur $admin): bool
    {
        $sql = "INSERT INTO Administrateur (nom, prenom, email, motDePasse) VALUES (:nom, :prenom, :email, :motDePasse)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $admin->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $admin->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $admin->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':motDePasse', $admin->getMotDePasse(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateAdministrateur(Administrateur $admin): bool
    {
        $sql = "UPDATE Administrateur SET nom = :nom, prenom = :prenom, email = :email, motDePasse = :motDePasse WHERE idAdministrateur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $admin->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $admin->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $admin->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':motDePasse', $admin->getMotDePasse(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $admin->getIdAdministrateur(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteAdministrateur(int $id): bool
    {
        $sql = "DELETE FROM Administrateur WHERE idAdministrateur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
