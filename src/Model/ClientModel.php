<?php
declare(strict_types=1);
namespace MyApp\Model;

use MyApp\Entity\Client;
use PDO;

class ClientModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllClients(): array
    {
        $sql = "SELECT * FROM Client";
        $stmt = $this->db->query($sql);
        $clients = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clients[] = new Client($row['idClient'], $row['nom'], $row['prenom'], $row['email'], $row['motDePasse']);
        }
        return $clients;
    }

    public function getOneClient(int $id): ?Client
    {
        $sql = "SELECT * FROM Client WHERE idClient = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Client($row['idClient'], $row['nom'], $row['prenom'], $row['email'], $row['motDePasse']);
    }

    public function createClient(Client $client): bool
    {
        $sql = "INSERT INTO Client (nom, prenom, email, motDePasse) VALUES (:nom, :prenom, :email, :motDePasse)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $client->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $client->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $client->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':motDePasse', $client->getMotDePasse(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateClient(Client $client): bool
    {
        $sql = "UPDATE Client SET nom = :nom, prenom = :prenom, email = :email, motDePasse = :motDePasse WHERE idClient = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $client->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $client->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $client->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':motDePasse', $client->getMotDePasse(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $client->getIdClient(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteClient(int $id): bool
    {
        $sql = "DELETE FROM Client WHERE idClient = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
