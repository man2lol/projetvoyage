<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\Etape;
use MyApp\Entity\Circuit;
use MyApp\Entity\LieuAvisiter;
use PDO;

class EtapeModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllEtapes(): array
    {
        $sql = "SELECT e.identifiant_circuit, e.ordre, e.date_etape, e.duree, e.nom_lieu, e.ville, e.pays, 
                c.descriptif_ as circuit_desc, l.descriptif_ as lieu_desc
                FROM Etape e 
                INNER JOIN Circuit c ON e.identifiant_circuit = c.identifiant_circuit 
                INNER JOIN LieuAvisiter l ON e.nom_lieu = l.nom_lieu AND e.ville = l.ville AND e.pays = l.pays 
                ORDER BY e.identifiant_circuit, e.ordre";
        
        $stmt = $this->db->query($sql);
        $etapes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $circuit = new Circuit($row['identifiant_circuit'], $row['circuit_desc']);
            $lieu = new LieuAvisiter($row['nom_lieu'], $row['ville'], $row['pays'], $row['lieu_desc']);
            $etapes[] = new Etape($row['identifiant_circuit'], $row['ordre'], $row['date_etape'], $row['duree'], $row['nom_lieu'], $row['ville'], $row['pays']);
        }
        return $etapes;
    }

    public function getOneEtape(int $identifiant_circuit, int $ordre): ?Etape
    {
        $sql = "SELECT e.identifiant_circuit, e.ordre, e.date_etape, e.duree, e.nom_lieu, e.ville, e.pays, 
                c.descriptif_ as circuit_desc, l.descriptif_ as lieu_desc
                FROM Etape e 
                INNER JOIN Circuit c ON e.identifiant_circuit = c.identifiant_circuit 
                INNER JOIN LieuAvisiter l ON e.nom_lieu = l.nom_lieu AND e.ville = l.ville AND e.pays = l.pays
                WHERE e.identifiant_circuit = :identifiant_circuit AND e.ordre = :ordre";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":identifiant_circuit", $identifiant_circuit, PDO::PARAM_INT);
        $stmt->bindValue(":ordre", $ordre, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $circuit = new Circuit($row['identifiant_circuit'], $row['circuit_desc']);
        $lieu = new LieuAvisiter($row['nom_lieu'], $row['ville'], $row['pays'], $row['lieu_desc']);
        return new Etape($row['identifiant_circuit'], $row['ordre'], $row['date_etape'], $row['duree'], $row['nom_lieu'], $row['ville'], $row['pays']);
    }

    public function createEtape(Etape $etape): bool
    {
        $sql = "INSERT INTO Etape (identifiant_circuit, ordre, date_etape, duree, nom_lieu, ville, pays) 
                VALUES (:identifiant_circuit, :ordre, :date_etape, :duree, :nom_lieu, :ville, :pays)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':identifiant_circuit', $etape->getIdentifiantCircuit(), PDO::PARAM_INT);
        $stmt->bindValue(':ordre', $etape->getOrdre(), PDO::PARAM_INT);
        $stmt->bindValue(':date_etape', $etape->getDateEtape(), PDO::PARAM_STR);
        $stmt->bindValue(':duree', $etape->getDuree(), PDO::PARAM_INT);
        $stmt->bindValue(':nom_lieu', $etape->getNomLieu(), PDO::PARAM_STR);
        $stmt->bindValue(':ville', $etape->getVille(), PDO::PARAM_STR);
        $stmt->bindValue(':pays', $etape->getPays(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateEtape(Etape $etape): bool
    {
        $sql = "UPDATE Etape SET date_etape = :date_etape, duree = :duree, nom_lieu = :nom_lieu, ville = :ville, pays = :pays
                WHERE identifiant_circuit = :identifiant_circuit AND ordre = :ordre";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':date_etape', $etape->getDateEtape(), PDO::PARAM_STR);
        $stmt->bindValue(':duree', $etape->getDuree(), PDO::PARAM_INT);
        $stmt->bindValue(':nom_lieu', $etape->getNomLieu(), PDO::PARAM_STR);
        $stmt->bindValue(':ville', $etape->getVille(), PDO::PARAM_STR);
        $stmt->bindValue(':pays', $etape->getPays(), PDO::PARAM_STR);
        $stmt->bindValue(':identifiant_circuit', $etape->getIdentifiantCircuit(), PDO::PARAM_INT);
        $stmt->bindValue(':ordre', $etape->getOrdre(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteEtape(int $identifiant_circuit, int $ordre): bool
    {
        $sql = "DELETE FROM Etape WHERE identifiant_circuit = :identifiant_circuit AND ordre = :ordre";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':identifiant_circuit', $identifiant_circuit, PDO::PARAM_INT);
        $stmt->bindValue(':ordre', $ordre, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
