<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\Beneficiaire;
use PDO;

class BeneficiaireModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllBeneficiaires(): array
    {
        $sql = "SELECT * FROM Beneficiaire";
        $stmt = $this->db->query($sql);
        $beneficiaires = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $beneficiaires[] = new Beneficiaire($row['idBeneficiaire'], $row['nom'], $row['prenom'], $row['dateNaissance']);
        }
        return $beneficiaires;
    }

    public function getOneBeneficiaire(int $id): ?Beneficiaire
    {
        $sql = "SELECT * FROM Beneficiaire WHERE idBeneficiaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Beneficiaire($row['idBeneficiaire'], $row['nom'], $row['prenom'], $row['dateNaissance']);
    }

    public function createBeneficiaire(Beneficiaire $beneficiaire): bool
    {
        $sql = "INSERT INTO Beneficiaire (nom, prenom, dateNaissance) VALUES (:nom, :prenom, :dateNaissance)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $beneficiaire->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $beneficiaire->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':dateNaissance', $beneficiaire->getDateNaissance(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateBeneficiaire(Beneficiaire $beneficiaire): bool
    {
        $sql = "UPDATE Beneficiaire SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance WHERE idBeneficiaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $beneficiaire->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $beneficiaire->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':dateNaissance', $beneficiaire->getDateNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $beneficiaire->getIdBeneficiaire(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteBeneficiaire(int $id): bool
    {
        $sql = "DELETE FROM Beneficiaire WHERE idBeneficiaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
