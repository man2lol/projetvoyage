<?php
declare(strict_types=1);

namespace MyApp\Controller;

use MyApp\Entity\ReservationClient;
use MyApp\Model\ReservationModel;
use MyApp\Model\ClientModel;
use MyApp\Model\CircuitModel;
use MyApp\Service\DependencyContainer;
use Twig\Environment;

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: /admin/login");
    exit;
}

class ReservationClientController
{
    private $twig;
    private ReservationModel $reservationModel;
    private ClientModel $clientModel;
    private CircuitModel $circuitModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->reservationModel = $dependencyContainer->get('ReservationModel');
        $this->clientModel = $dependencyContainer->get('ClientModel');
        $this->circuitModel = $dependencyContainer->get('CircuitModel');
    }

    // 🔹 Liste des réservations des clients
    public function listReservations()
    {
        $reservations = $this->reservationModel->getAllReservations();
        echo $this->twig->render('reservationClientController/listReservations.html.twig', ['reservations' => $reservations]);
    }

    // 🔹 Ajouter une réservation
    public function addReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_client = filter_input(INPUT_POST, 'id_client', FILTER_SANITIZE_NUMBER_INT);
            $id_circuit = filter_input(INPUT_POST, 'id_circuit', FILTER_SANITIZE_NUMBER_INT);
            $date_reservation = filter_input(INPUT_POST, 'date_reservation', FILTER_SANITIZE_STRING);
            $nbr_places_reservation = filter_input(INPUT_POST, 'nbr_places_reservation', FILTER_SANITIZE_NUMBER_INT);

            if (!empty($id_client) && !empty($id_circuit) && !empty($date_reservation) && !empty($nbr_places_reservation)) {
                $reservation = new ReservationClient(null, $date_reservation, $nbr_places_reservation, $id_circuit, $id_client);
                $this->reservationModel->createReservation($reservation);
                header('Location: index.php?page=list-reservations');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        }

        // Récupération des clients et circuits pour affichage dans le formulaire
        $clients = $this->clientModel->getAllClients();
        $circuits = $this->circuitModel->getAllCircuits();
        
        echo $this->twig->render('reservationClientController/addReservation.html.twig', [
            'clients' => $clients,
            'circuits' => $circuits
        ]);
    }

    // 🔹 Modifier une réservation
    public function updateReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_reservation = filter_input(INPUT_POST, 'id_reservation', FILTER_SANITIZE_NUMBER_INT);
            $id_client = filter_input(INPUT_POST, 'id_client', FILTER_SANITIZE_NUMBER_INT);
            $id_circuit = filter_input(INPUT_POST, 'id_circuit', FILTER_SANITIZE_NUMBER_INT);
            $date_reservation = filter_input(INPUT_POST, 'date_reservation', FILTER_SANITIZE_STRING);
            $nbr_places_reservation = filter_input(INPUT_POST, 'nbr_places_reservation', FILTER_SANITIZE_NUMBER_INT);

            if (!empty($id_reservation) && !empty($id_client) && !empty($id_circuit) && !empty($date_reservation) && !empty($nbr_places_reservation)) {
                $reservation = new ReservationClient($id_reservation, $date_reservation, $nbr_places_reservation, $id_circuit, $id_client);
                $this->reservationModel->updateReservation($reservation);
                header('Location: index.php?page=list-reservations');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        } else {
            $id_reservation = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $reservation = $this->reservationModel->getOneReservation($id_reservation);
            $clients = $this->clientModel->getAllClients();
            $circuits = $this->circuitModel->getAllCircuits();
            
            echo $this->twig->render('reservationClientController/updateReservation.html.twig', [
                'reservation' => $reservation,
                'clients' => $clients,
                'circuits' => $circuits
            ]);
        }
    }

    // 🔹 Supprimer une réservation
    public function deleteReservation()
    {
        $id_reservation = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->reservationModel->deleteReservation($id_reservation);
        header('Location: index.php?page=list-reservations');
    }

    // 🔹 Afficher les détails de la réservation
    public function showReservationDetails()
    {
        $id_reservation = filter_input(INPUT_GET, 'id_reservation', FILTER_SANITIZE_NUMBER_INT);
        $reservation = $this->reservationModel->getOneReservation($id_reservation);
        echo $this->twig->render('reservationClientController/showReservationDetails.html.twig', ['reservation' => $reservation]);
    }
}
