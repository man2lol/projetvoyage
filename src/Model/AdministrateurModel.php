<?php
declare(strict_types=1);

namespace MyApp\Model;

use MyApp\Entity\Administrateur;
use PDO;
use PDOException;

class AdministrateurModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    
    public function getAllAdministrateurs(): array
    {
        $sql = "SELECT identifiantAdmin, Nom, identifiant FROM Administrateur";
        $stmt = $this->db->query($sql);
        $administrateurs = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $administrateurs[] = new Administrateur($row['identifiantAdmin'], $row['Nom'], $row['identifiant'], '');
        }
        
        return $administrateurs;
    }

    
    public function getOneAdministrateur(int $id): ?Administrateur
    {
        $sql = "SELECT identifiantAdmin, Nom, identifiant, password FROM Administrateur WHERE identifiantAdmin = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        
        return new Administrateur($row['identifiantAdmin'], $row['Nom'], $row['identifiant'], $row['password']);
    }

   
    public function getAdministrateurByIdentifiant(string $identifiant): ?Administrateur
    {
        $sql = "SELECT identifiantAdmin, Nom, identifiant, password FROM Administrateur WHERE identifiant = :identifiant";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":identifiant", $identifiant, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return new Administrateur($row['identifiantAdmin'], $row['Nom'], $row['identifiant'], $row['password']);
    }

   
    public function createAdministrateur(Administrateur $admin): bool
    {
        
        if ($this->getAdministrateurByIdentifiant($admin->getIdentifiant())) {
            return false; 
        }
    
        $sql = "INSERT INTO Administrateur (Nom, identifiant, password) VALUES (:Nom, :identifiant, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Nom', $admin->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':identifiant', $admin->getIdentifiant(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $admin->getPassword(), PDO::PARAM_STR); 
    
        return $stmt->execute();
    }
    

   
    public function updateAdministrateur(Administrateur $admin): bool
    {
        $sql = "UPDATE Administrateur SET Nom = :Nom, identifiant = :identifiant WHERE identifiantAdmin = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':Nom', $admin->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':identifiant', $admin->getIdentifiant(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $admin->getIdAdministrateur(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    
    public function updatePassword(int $id, string $newPassword): bool
    {
        $sql = "UPDATE Administrateur SET password = :password WHERE identifiantAdmin = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':password', password_hash($newPassword, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

  
    public function deleteAdministrateur(int $id): bool
    {
        $sql = "DELETE FROM Administrateur WHERE identifiantAdmin = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
