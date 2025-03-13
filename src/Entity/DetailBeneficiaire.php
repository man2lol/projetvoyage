<?php
declare(strict_types=1);
namespace MyApp\Entity;

use MyApp\Entity\ReservationClient;
use MyApp\Entity\Beneficiaire;

class DetailBeneficiaire
{
    private ?int $idReservation; 
    private ?int $idBeneficiaire; 
    
    private ReservationClient $reservationClient;
    private Beneficiaire $beneficiaire;

    public function __construct(
        ?int $idReservation,
        ?int $idBeneficiaire,
        ReservationClient $reservationClient,
        Beneficiaire $beneficiaire
    ) {
        $this->idReservation = $idReservation;
        $this->idBeneficiaire = $idBeneficiaire;
        $this->reservationClient = $reservationClient;
        $this->beneficiaire = $beneficiaire;
    }

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function setIdReservation(?int $idReservation): void
    {
        $this->idReservation = $idReservation;
    }

    public function getIdBeneficiaire(): ?int
    {
        return $this->idBeneficiaire;
    }

    public function setIdBeneficiaire(?int $idBeneficiaire): void
    {
        $this->idBeneficiaire = $idBeneficiaire;
    }

    public function getReservationClient(): ReservationClient
    {
        return $this->reservationClient;
    }

    public function setReservationClient(ReservationClient $reservationClient): void
    {
        $this->reservationClient = $reservationClient;
    }

    public function getBeneficiaire(): Beneficiaire
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(Beneficiaire $beneficiaire): void
    {
        $this->beneficiaire = $beneficiaire;
    }
}
