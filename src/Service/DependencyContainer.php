<?php
namespace MyApp\Service;

use MyApp\Model\AdministrateurModel;
use MyApp\Model\BeneficiaireModel;
use MyApp\Model\CircuitModel;
use MyApp\Model\ClientModel;
use MyApp\Model\DetailBneficiareModel;
use MyApp\Model\EtapeModel;
use MyApp\Model\LieuAvisiterModel;
use MyApp\Model\ReservationModel;

use PDO;

class DependencyContainer
{
    private $instances = [];

    public function __construct()
    {
    }

    public function get($key)
    {
        if (!isset($this->instances[$key])) {
            $this->instances[$key] = $this->createInstance($key);
        }

        return $this->instances[$key];
    }

    private function createInstance($key)
    {
        switch ($key) {
            case 'PDO':
                return $this->createPDOInstance();

            case 'AdministrateurModel':

                $pdo = $this->get('PDO');
                return new AdministrateurModel($pdo);
            case 'BeneficiaireModel':

                $pdo = $this->get('PDO');
                return new BeneficiaireModel($pdo);
            case 'CircuitModel':

                $pdo = $this->get('PDO');
                return new CircuitModel($pdo);
            case 'ClientModel':

                $pdo = $this->get('PDO');
                return new ClientModel($pdo);
            case 'ClientModel':

                $pdo = $this->get('PDO');
                return new ClientModel($pdo);

            case 'DetailBeneficiaire':

                $pdo = $this->get('PDO');
                return new DetailBeneficiaire($pdo);
            case 'EtapeModel':

                $pdo = $this->get('PDO');
                return new EtapeModel($pdo);
            case 'LieuAvisiter':

                $pdo = $this->get('PDO');
                return new LieuAvisiter($pdo);
            case 'ReservationClient':

                $pdo = $this->get('PDO');
                return new ReservationClient($pdo);
            
            default:
                throw new \Exception("No service found for key: " . $key);
        }
    }
    private function createPDOInstance()
    {
        try {
            $pdo = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' .
                $_ENV['DB_NAME'] . ';charset=utf8', $_ENV['DB_USER'], $_ENV['DB_PASS']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new \Exception("PDO connection error: " . $e->getMessage());
        }
    }
}
