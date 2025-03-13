<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\ReservationClient;
use MyApp\Entity\Circuit;
use MyApp\Entity\Client;
use PDO;

class ReservationClientModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllReservations(): array
    {
        $sql = "SELECT r.id_reservation, r.date_reservation, r.nbr_places_reservation, r.identifiant_circuit, r.identifiantClient,
                c.descriptif_ as circuit_desc, cl.Nom as client_nom, cl.Prenom as client_prenom
                FROM Reservation_client r
                INNER JOIN Circuit c ON r.identifiant_circuit = c.identifiant_circuit
                INNER JOIN Client cl ON r.identifiantClient = cl.identifiantClient";
        
        $stmt = $this->db->query($sql);
        $reservations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $circuit = new Circuit($row['identifiant_circuit'], $row['circuit_desc']);
            $client = new Client($row['identifiantClient'], $row['client_nom'], $row['client_prenom']);
            $reservations[] = new ReservationClient($row['id_reservation'], $row['date_reservation'], $row['nbr_places_reservation'], $row['identifiant_circuit'], $row['identifiantClient']);
        }
        return $reservations;
    }

    public function getOneReservation(int $id_reservation): ?ReservationClient
    {
        $sql = "SELECT r.id_reservation, r.date_reservation, r.nbr_places_reservation, r.identifiant_circuit, r.identifiantClient,
                c.descriptif_ as circuit_desc, cl.Nom as client_nom, cl.Prenom as client_prenom
                FROM Reservation_client r
                INNER JOIN Circuit c ON r.identifiant_circuit = c.identifiant_circuit
                INNER JOIN Client cl ON r.identifiantClient = cl.identifiantClient
                WHERE r.id_reservation = :id_reservation";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id_reservation", $id_reservation, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $circuit = new Circuit($row['identifiant_circuit'], $row['circuit_desc']);
        $client = new Client($row['identifiantClient'], $row['client_nom'], $row['client_prenom']);
        return new ReservationClient($row['id_reservation'], $row['date_reservation'], $row['nbr_places_reservation'], $row['identifiant_circuit'], $row['identifiantClient']);
    }

    public function createReservation(ReservationClient $reservation): bool
    {
        $sql = "INSERT INTO Reservation_client (date_reservation, nbr_places_reservation, identifiant_circuit, identifiantClient) 
                VALUES (:date_reservation, :nbr_places_reservation, :identifiant_circuit, :identifiantClient)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':date_reservation', $reservation->getDateReservation(), PDO::PARAM_STR);
        $stmt->bindValue(':nbr_places_reservation', $reservation->getNbrPlacesReservation(), PDO::PARAM_INT);
        $stmt->bindValue(':identifiant_circuit', $reservation->getIdentifiantCircuit(), PDO::PARAM_INT);
        $stmt->bindValue(':identifiantClient', $reservation->getIdentifiantClient(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateReservation(ReservationClient $reservation): bool
    {
        $sql = "UPDATE Reservation_client SET date_reservation = :date_reservation, nbr_places_reservation = :nbr_places_reservation
                WHERE id_reservation = :id_reservation";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':date_reservation', $reservation->getDateReservation(), PDO::PARAM_STR);
        $stmt->bindValue(':nbr_places_reservation', $reservation->getNbrPlacesReservation(), PDO::PARAM_INT);
        $stmt->bindValue(':id_reservation', $reservation->getIdReservation(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteReservation(int $id_reservation): bool
    {
        $sql = "DELETE FROM Reservation_client WHERE id_reservation = :id_reservation";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_reservation', $id_reservation, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
