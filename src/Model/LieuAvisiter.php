<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\LieuAvisiter;
use PDO;

class LieuAvisiterModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllLieux(): array
    {
        $sql = "SELECT * FROM LieuAvisiter";
        $stmt = $this->db->query($sql);
        $lieux = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lieux[] = new LieuAvisiter($row['nom_lieu'], $row['ville'], $row['pays'], $row['descriptif_']);
        }
        return $lieux;
    }

    public function getOneLieu(string $nom_lieu, string $ville, string $pays): ?LieuAvisiter
    {
        $sql = "SELECT * FROM LieuAvisiter WHERE nom_lieu = :nom_lieu AND ville = :ville AND pays = :pays";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":nom_lieu", $nom_lieu, PDO::PARAM_STR);
        $stmt->bindValue(":ville", $ville, PDO::PARAM_STR);
        $stmt->bindValue(":pays", $pays, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new LieuAvisiter($row['nom_lieu'], $row['ville'], $row['pays'], $row['descriptif_']);
    }

    public function createLieu(LieuAvisiter $lieu): bool
    {
        $sql = "INSERT INTO LieuAvisiter (nom_lieu, ville, pays, descriptif_) VALUES (:nom_lieu, :ville, :pays, :descriptif_)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom_lieu', $lieu->getNomLieu(), PDO::PARAM_STR);
        $stmt->bindValue(':ville', $lieu->getVille(), PDO::PARAM_STR);
        $stmt->bindValue(':pays', $lieu->getPays(), PDO::PARAM_STR);
        $stmt->bindValue(':descriptif_', $lieu->getDescriptif(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateLieu(LieuAvisiter $lieu): bool
    {
        $sql = "UPDATE LieuAvisiter SET descriptif_ = :descriptif_ WHERE nom_lieu = :nom_lieu AND ville = :ville AND pays = :pays";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':descriptif_', $lieu->getDescriptif(), PDO::PARAM_STR);
        $stmt->bindValue(':nom_lieu', $lieu->getNomLieu(), PDO::PARAM_STR);
        $stmt->bindValue(':ville', $lieu->getVille(), PDO::PARAM_STR);
        $stmt->bindValue(':pays', $lieu->getPays(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteLieu(string $nom_lieu, string $ville, string $pays): bool
    {
        $sql = "DELETE FROM LieuAvisiter WHERE nom_lieu = :nom_lieu AND ville = :ville AND pays = :pays";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom_lieu', $nom_lieu, PDO::PARAM_STR);
        $stmt->bindValue(':ville', $ville, PDO::PARAM_STR);
        $stmt->bindValue(':pays', $pays, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
