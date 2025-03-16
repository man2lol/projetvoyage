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
            $circuits[] = new Circuit(
                $row['identifiant_circuit'],
                $row['descriptif'],
                $row['villeDepart'],
                $row['paysDepart'],
                $row['villeArrivee'],
                $row['paysArrivee'],
                $row['date_Depart'],
                $row['nbr_place_disponible'],
                $row['duree'],
                $row['prixInscription']
            );
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
        return new Circuit(
            $row['identifiant_circuit'],
            $row['descriptif'],
            $row['villeDepart'],
            $row['paysDepart'],
            $row['villeArrivee'],
            $row['paysArrivee'],
            $row['date_Depart'],
            $row['nbr_place_disponible'],
            $row['duree'],
            $row['prixInscription']
        );
    }

    public function createCircuit(Circuit $circuit): bool
    {
        $sql = "INSERT INTO Circuit 
                (descriptif, villeDepart, paysDepart, villeArrivee, paysArrivee, date_Depart, nbr_place_disponible, duree, prixInscription) 
                VALUES 
                (:descriptif, :villeDepart, :paysDepart, :villeArrivee, :paysArrivee, :date_Depart, :nbr_place_disponible, :duree, :prixInscription)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':descriptif', $circuit->getDescriptif(), PDO::PARAM_STR);
        $stmt->bindValue(':villeDepart', $circuit->getVilleDepart(), PDO::PARAM_STR);
        $stmt->bindValue(':paysDepart', $circuit->getPaysDepart(), PDO::PARAM_STR);
        $stmt->bindValue(':villeArrivee', $circuit->getVilleArrivee(), PDO::PARAM_STR);
        $stmt->bindValue(':paysArrivee', $circuit->getPaysArrivee(), PDO::PARAM_STR);
        $stmt->bindValue(':date_Depart', $circuit->getDateDepart(), PDO::PARAM_STR);
        $stmt->bindValue(':nbr_place_disponible', $circuit->getNbrPlaceDisponible(), PDO::PARAM_INT);
        $stmt->bindValue(':duree', $circuit->getDuree(), PDO::PARAM_INT);
        $stmt->bindValue(':prixInscription', $circuit->getPrixInscription(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateCircuit(Circuit $circuit): bool
    {
        $sql = "UPDATE Circuit SET 
                    descriptif = :descriptif_,
                    villeDepart = :villeDepart,
                    paysDepart = :paysDepart,
                    villeArrivee = :villeArrivee,
                    paysArrivee = :paysArrivee,
                    date_Depart = :date_Depart,
                    nbr_place_disponible = :nbr_place_disponible,
                    duree = :duree,
                    prixInscription = :prixInscription
                WHERE identifiant_circuit = :identifiant_circuit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':descriptif', $circuit->getDescriptif(), PDO::PARAM_STR);
        $stmt->bindValue(':villeDepart', $circuit->getVilleDepart(), PDO::PARAM_STR);
        $stmt->bindValue(':paysDepart', $circuit->getPaysDepart(), PDO::PARAM_STR);
        $stmt->bindValue(':villeArrivee', $circuit->getVilleArrivee(), PDO::PARAM_STR);
        $stmt->bindValue(':paysArrivee', $circuit->getPaysArrivee(), PDO::PARAM_STR);
        $stmt->bindValue(':date_Depart', $circuit->getDateDepart(), PDO::PARAM_STR);
        $stmt->bindValue(':nbr_place_disponible', $circuit->getNbrPlaceDisponible(), PDO::PARAM_INT);
        $stmt->bindValue(':duree', $circuit->getDuree(), PDO::PARAM_INT);
        $stmt->bindValue(':prixInscription', $circuit->getPrixInscription(), PDO::PARAM_STR);
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

