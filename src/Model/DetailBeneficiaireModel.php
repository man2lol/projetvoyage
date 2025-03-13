<?php
declare(strict_types=1);

namespace MyApp\Model;

use MyApp\Entity\DetailBeneficiaire;
use MyApp\Entity\ReservationClient;
use MyApp\Entity\Beneficiaire;
use PDO;

class DetailBeneficiaireModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllDetailBeneficiaires(): array
    {
        $sql = "SELECT db.idReservation, db.idBeneficiaire, 
        r.dateReservation, r.nbrPlacesReservation, r.identifiantCircuit, r.identifiantClient,
        b.nom, b.prenom 
 FROM DetailBeneficiaire db
 INNER JOIN ReservationClient r ON db.idReservation = r.idReservation
 INNER JOIN Beneficiaire b ON db.idBeneficiaire = b.idBeneficiaire";

        $stmt = $this->db->query($sql);
        $details = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reservation = new ReservationClient(
                $row['idReservation'],
                $row['dateReservation'],
                $row['nbrPlacesReservation'],
                $row['identifiantCircuit'], 
                $row['identifiantClient']   
            );

            $beneficiaire = new Beneficiaire($row['idBeneficiaire'], $row['nom'], $row['prenom']);
            
            $details[] = new DetailBeneficiaire($reservation->getIdReservation(), $beneficiaire->getIdBeneficiaire());
        }

        return $details;
    }

    public function getOneDetailBeneficiaire(int $idReservation, int $idBeneficiaire): ?DetailBeneficiaire
    {
        $sql = "SELECT db.idReservation, db.idBeneficiaire, 
                       r.dateReservation, r.nbrPlacesReservation, 
                       b.nom, b.prenom 
                FROM DetailBeneficiaire db
                INNER JOIN ReservationClient r ON db.idReservation = r.idReservation
                INNER JOIN Beneficiaire b ON db.idBeneficiaire = b.idBeneficiaire
                WHERE db.idReservation = :idReservation AND db.idBeneficiaire = :idBeneficiaire";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":idReservation", $idReservation, PDO::PARAM_INT);
        $stmt->bindValue(":idBeneficiaire", $idBeneficiaire, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $reservation = new ReservationClient(
            $row['idReservation'],
            $row['dateReservation'],
            $row['nbrPlacesReservation'],
            $row['identifiantCircuit'], 
            $row['identifiantClient']   
        );

        $beneficiaire = new Beneficiaire($row['idBeneficiaire'], $row['nom'], $row['prenom']);

        return new DetailBeneficiaire($reservation->getIdReservation(), $beneficiaire->getIdBeneficiaire());
    }

    public function createDetailBeneficiaire(DetailBeneficiaire $detailBeneficiaire): bool
    {
        $sql = "INSERT INTO DetailBeneficiaire (idReservation, idBeneficiaire) VALUES (:idReservation, :idBeneficiaire)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idReservation', $detailBeneficiaire->getIdReservation(), PDO::PARAM_INT);
        $stmt->bindValue(':idBeneficiaire', $detailBeneficiaire->getIdBeneficiaire(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteDetailBeneficiaire(int $idReservation, int $idBeneficiaire): bool
    {
        $sql = "DELETE FROM DetailBeneficiaire WHERE idReservation = :idReservation AND idBeneficiaire = :idBeneficiaire";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idReservation', $idReservation, PDO::PARAM_INT);
        $stmt->bindValue(':idBeneficiaire', $idBeneficiaire, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
