<?php
declare(strict_types=1);

namespace MyApp\Controller;

use MyApp\Entity\Client;
use MyApp\Entity\ReservationClient;
use MyApp\Entity\Beneficiaire;
use MyApp\Model\ClientModel;
use MyApp\Model\ReservationModel;
use MyApp\Model\DetailBeneficiaireModel;
use MyApp\Model\BeneficiaireModel;
use MyApp\Service\DependencyContainer;
use Twig\Environment;



class ClientController
{
    private  $twig;
    private ClientModel $clientModel;
    private ReservationModel $reservationModel;
    private DetailBeneficiaireModel $detailBeneficiaireModel;
    private BeneficiaireModel $beneficiaireModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->clientModel = $dependencyContainer->get('ClientModel');
        $this->reservationModel = $dependencyContainer->get('ReservationModel');
        $this->detailBeneficiaireModel = $dependencyContainer->get('DetailBeneficiaireModel');
        $this->beneficiaireModel = $dependencyContainer->get('BeneficiaireModel');
    }

    // 🔹 Liste des clients
    public function listClients()
    {
        $clients = $this->clientModel->getAllClients();
        echo $this->twig->render('clientController/listClients.html.twig', ['clients' => $clients]);
    }

    // 🔹 Ajouter un client
    public function addClient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
            $date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_STRING);
            $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if (!empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($identifiant) && !empty($password)) {
                $client = new Client(null, $nom, $prenom, $date_naissance, $identifiant, $password);
                $this->clientModel->createClient($client);
                header('Location: index.php?page=list-clients');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        }
        echo $this->twig->render('clientController/addClient.html.twig');
    }

    // 🔹 Modifier un client
    public function updateClient()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
            $date_naissance = filter_input(INPUT_POST, 'date_naissance', FILTER_SANITIZE_STRING);
            $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);

            if (!empty($id) && !empty($nom) && !empty($prenom) && !empty($date_naissance) && !empty($identifiant)) {
                $client = new Client($id, $nom, $prenom, $date_naissance, $identifiant, '');
                $this->clientModel->updateClient($client);
                header('Location: index.php?page=list-clients');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $client = $this->clientModel->getOneClient($id);
            echo $this->twig->render('clientController/updateClient.html.twig', ['client' => $client]);
        }
    }

    // 🔹 Supprimer un client
    public function deleteClient()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->clientModel->deleteClient($id);
        header('Location: index.php?page=list-clients');
    }

    // 🔹 Afficher les réservations d'un client
    public function showClientReservations()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $client = $this->clientModel->getOneClient($id);
        $reservations = $this->reservationModel->getReservationsByClient($id);

        echo $this->twig->render('clientController/showReservations.html.twig', [
            'client' => $client,
            'reservations' => $reservations
        ]);
    }

    // 🔹 Voir les bénéficiaires d'une réservation
    public function showBeneficiaries()
    {
        $id_reservation = filter_input(INPUT_GET, 'id_reservation', FILTER_SANITIZE_NUMBER_INT);
        $beneficiaires = $this->detailBeneficiaireModel->getBeneficiairesByReservation($id_reservation);

        echo $this->twig->render('clientController/showBeneficiaries.html.twig', [
            'beneficiaires' => $beneficiaires
        ]);
    }
}
