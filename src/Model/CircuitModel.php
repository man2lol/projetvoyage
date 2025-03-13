<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\Circuit;
use PDO;

class CircuitModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCircuits(): array
    {
        $sql = "SELECT * FROM Circuit";
        $stmt = $this->db->query($sql);
        $circuits = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $circuits[] = new Circuit($row['identifiant_circuit'], $row['descriptif_']);
        }
        return $circuits;
    }

    public function getOneCircuit(int $identifiant_circuit): ?Circuit
    {
        $sql = "SELECT * FROM Circuit WHERE identifiant_circuit = :identifiant_circuit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":identifiant_circuit", $identifiant_circuit, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Circuit($row['identifiant_circuit'], $row['descriptif_']);
    }

    public function createCircuit(Circuit $circuit): bool
    {
        $sql = "INSERT INTO Circuit (descriptif_) VALUES (:descriptif_)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':descriptif_', $circuit->getDescriptif(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateCircuit(Circuit $circuit): bool
    {
        $sql = "UPDATE Circuit SET descriptif_ = :descriptif_ WHERE identifiant_circuit = :identifiant_circuit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':descriptif_', $circuit->getDescriptif(), PDO::PARAM_STR);
        $stmt->bindValue(':identifiant_circuit', $circuit->getIdentifiantCircuit(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteCircuit(int $identifiant_circuit): bool
    {
        $sql = "DELETE FROM Circuit WHERE identifiant_circuit = :identifiant_circuit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':identifiant_circuit', $identifiant_circuit, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
