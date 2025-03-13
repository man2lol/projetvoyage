<?php
declare(strict_types=1);
namespace MyApp\Entity;

use MyApp\Entity\Circuit;
use MyApp\Entity\Client;

class ReservationClient
{
    private ?int $idReservation = null;
    private string $dateReservation;
    private int $nbrPlacesReservation;
    private int $identifiantCircuit;
    private int $identifiantClient;

    
    private Circuit $circuit; 
    private Client $client;  

    public function __construct(
        ?int $idReservation,
        string $dateReservation,
        int $nbrPlacesReservation,
        int $identifiantCircuit,
        int $identifiantClient,
        Circuit $circuit,   
        Client $client      
    ) {
        $this->idReservation = $idReservation;
        $this->dateReservation = $dateReservation;
        $this->nbrPlacesReservation = $nbrPlacesReservation;
        $this->identifiantCircuit = $identifiantCircuit;
        $this->identifiantClient = $identifiantClient;
        $this->circuit = $circuit;  
        $this->client = $client;   
    }

   
    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function setIdReservation(?int $idReservation): void
    {
        $this->idReservation = $idReservation;
    }

   
    public function getDateReservation(): string
    {
        return $this->dateReservation;
    }

    public function setDateReservation(string $dateReservation): void
    {
        $this->dateReservation = $dateReservation;
    }

  
    public function getNbrPlacesReservation(): int
    {
        return $this->nbrPlacesReservation;
    }

    public function setNbrPlacesReservation(int $nbrPlacesReservation): void
    {
        $this->nbrPlacesReservation = $nbrPlacesReservation;
    }

   
    public function getIdentifiantCircuit(): int
    {
        return $this->identifiantCircuit;
    }

    public function setIdentifiantCircuit(int $identifiantCircuit): void
    {
        $this->identifiantCircuit = $identifiantCircuit;
    }

   
    public function getIdentifiantClient(): int
    {
        return $this->identifiantClient;
    }

    public function setIdentifiantClient(int $identifiantClient): void
    {
        $this->identifiantClient = $identifiantClient;
    }

   
    public function getCircuit(): Circuit
    {
        return $this->circuit;
    }

    public function setCircuit(Circuit $circuit): void
    {
        $this->circuit = $circuit;
    }

   
    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
