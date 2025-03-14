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
            $clients[] = new Client(
                $row['identifiantClient'],
                $row['Nom'],
                $row['Prenom'],
                $row['date_naissance'],
                $row['identifiant'],
                $row['password']
            );
        }
        return $clients;
    }

    public function getOneClient(int $id): ?Client
    {
        $sql = "SELECT * FROM Client WHERE identifiantClient = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Client(
            $row['identifiantClient'],
            $row['Nom'],
            $row['Prenom'],
            $row['date_naissance'],
            $row['identifiant'],
            $row['password']
        );
    }

    public function createClient(Client $client): bool
    {
        $sql = "INSERT INTO Client (Nom, Prenom, date_naissance, identifiant, password) 
                VALUES (:nom, :prenom, :date_naissance, :identifiant, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $client->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $client->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':date_naissance', $client->getDateNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':identifiant', $client->getIdentifiant(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $client->getPassword(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateClient(Client $client): bool
    {
        $sql = "UPDATE Client 
                SET Nom = :nom, Prenom = :prenom, date_naissance = :date_naissance, identifiant = :identifiant, password = :password 
                WHERE identifiantClient = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $client->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $client->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':date_naissance', $client->getDateNaissance(), PDO::PARAM_STR);
        $stmt->bindValue(':identifiant', $client->getIdentifiant(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $client->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $client->getIdClient(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteClient(int $id): bool
    {
        $sql = "DELETE FROM Client WHERE identifiantClient = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
