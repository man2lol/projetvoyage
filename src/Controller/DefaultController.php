<?php
declare (strict_types = 1);
namespace MyApp\Controller;

use MyApp\Model\AdministrateurModel;
use MyApp\Model\BeneficiaireModel;
use MyApp\Model\CircuitModel;
use MyApp\Model\ClientModel;
use MyApp\Model\DetailBeneficiaireModel;
use MyApp\Model\EtapeModel;
use MyApp\Model\LieuAvisiterModel;
use MyApp\Model\ReservationClientModel;
use MyApp\Service\DependencyContainer;
use Twig\Environment;

class DefaultController
{
    private $twig;
    private $administrateurModel;
    private $beneficiaireModel;
    private $circuitModel;
    private $clientModel;
    private $detailBeneficiaireModel;
    private $etapeModel;
    private $lieuAvisiterModel;
    private $reservationClientModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->administrateurModel = $dependencyContainer->get('AdministrateurModel');
        $this->beneficiaireModel = $dependencyContainer->get('BeneficiaireModel');
        $this->circuitModel = $dependencyContainer->get('CircuitModel');
        $this->clientModel = $dependencyContainer->get('ClientModel');
        $this->detailBeneficiaireModel = $dependencyContainer->get('DetailBeneficiaireModel');
        $this->etapeModel = $dependencyContainer->get('EtapeModel');
        $this->lieuAvisiterModel = $dependencyContainer->get('LieuAvisiterModel');
        $this->reservationClientModel = $dependencyContainer->get('ReservationClientModel');
    }

    public function home()
    {
        $circuits = $this->circuitModel->getAllCircuits();
        echo $this->twig->render('defaultController/home.html.twig', ['circuits' => $circuits]);
    }

    public function administrateurs()
    {
        $administrateurs = $this->administrateurModel->getAllAdministrateurs();
        echo $this->twig->render('defaultController/administrateurs.html.twig', ['administrateurs' => $administrateurs]);
    }

    public function beneficiaires()
    {
        $beneficiaires = $this->beneficiaireModel->getAllBeneficiaires();
        echo $this->twig->render('defaultController/beneficiaires.html.twig', ['beneficiaires' => $beneficiaires]);
    }

    public function circuits()
    {
        $circuits = $this->circuitModel->getAllCircuits();
        echo $this->twig->render('defaultController/circuits.html.twig', ['circuits' => $circuits]);
    }

    public function clients()
    {
        $clients = $this->clientModel->getAllClients();
        echo $this->twig->render('defaultController/clients.html.twig', ['clients' => $clients]);
    }

    public function detailBeneficiaires()
    {
        $detailBeneficiaires = $this->detailBeneficiaireModel->getAllDetailsBeneficiaires();
        echo $this->twig->render('defaultController/detailBeneficiaires.html.twig', ['detailBeneficiaires' => $detailBeneficiaires]);
    }

    public function etapes()
    {
        $etapes = $this->etapeModel->getAllEtapes();
        echo $this->twig->render('defaultController/etapes.html.twig', ['etapes' => $etapes]);
    }

    public function lieuxAvisiter()
    {
        $lieux = $this->lieuAvisiterModel->getAllLieuxAvisiter();
        echo $this->twig->render('defaultController/lieuxAvisiter.html.twig', ['lieux' => $lieux]);
    }

    public function reservationsClients()
    {
        $reservations = $this->reservationClientModel->getAllReservationsClients();
        echo $this->twig->render('defaultController/reservationsClients.html.twig', ['reservations' => $reservations]);
    }

    public function error404()
    {
        echo $this->twig->render('defaultController/error404.html.twig', []);
    }

    public function error500()
    {
        echo $this->twig->render('defaultController/error500.html.twig', []);
    }

    public function error403()
    {
        echo $this->twig->render('defaultController/error403.html.twig', []);
    }

    public function login()
    {
        echo $this->twig->render('defaultController/login.html.twig');
    }

    public function loginAdmin()
    {
        echo $this->twig->render('defaultController/administrateurController/loginAdmin.html.twig');
    }

    public function register()
    {
        echo $this->twig->render('defaultController/register.html.twig');
    }

    public function registerAdmin()
    {
        echo $this->twig->render('defaultController/registerAdmin.html.twig');
    }

    public function voyage()
    {
        echo $this->twig->render('defaultController/voyage.html.twig');
    }

    public function detailBresil()
    {
        echo $this->twig->render('defaultController/detailBresil.html.twig');
    }

    public function detailEspagne()
    {
        echo $this->twig->render('defaultController/detailEspagne.html.twig');
    }

    public function detailEtatUnis()
    {
        echo $this->twig->render('defaultController/detailEtatUnis.html.twig');
    }

    public function detailMaroc()
    {
        echo $this->twig->render('defaultController/detailMaroc.html.twig');
    }

    public function reservationBresil()
    {
        echo $this->twig->render('defaultController/reservationBresil.html.twig');
    }

    public function reservationEspagne()
    {
        echo $this->twig->render('defaultController/reservationEspagne.html.twig');
    }

    public function reservationEtatUnis()
    {
        echo $this->twig->render('defaultController/reservationEtatUnis.html.twig');
    }

    public function reservationMaroc()
    {
        echo $this->twig->render('defaultController/reservationMaroc.html.twig');
    }

    public function reservationPackBresil()
    {
        echo $this->twig->render('defaultController/reservationPackBresil.html.twig');
    }

    public function reservationPackEspagne()
    {
        echo $this->twig->render('defaultController/reservationPackEspagne.html.twig');
    }

    public function reservationPackEtatUnis()
    {
        echo $this->twig->render('defaultController/reservationPackEtatUnis.html.twig');
    }

    public function reservationPackMaroc()
    {
        echo $this->twig->render('defaultController/reservationPackMaroc.html.twig');
    }

    public function information()
    {
        echo $this->twig->render('defaultController/information.html.twig');
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?page=loginAdmin"); // 🔹 Redirection vers la page de connexion admin
        exit;
    }
    // 🔹 Gestion des circuits
    public function adminCircuits()
    {
        echo $this->twig->render("admin/circuit_list.html.twig");
    }

    public function addCircuit()
    {
        echo $this->twig->render("admin/add_circuit.html.twig");
    }

    public function editCircuit()
    {
        echo $this->twig->render("admin/edit_circuit.html.twig");
    }

    public function deleteCircuit()
    {
        echo $this->twig->render("admin/delete_circuit.html.twig");
    }

// 🔹 Gestion des clients
    public function adminClients()
    {
        echo $this->twig->render("admin/client_list.html.twig");
    }

    public function editClient()
    {
        echo $this->twig->render("admin/edit_client.html.twig");
    }

    public function deleteClient()
    {
        echo $this->twig->render("admin/delete_client.html.twig");
    }

// 🔹 Gestion des réservations
    public function adminReservations()
    {
        echo $this->twig->render("admin/reservation_list.html.twig");
    }

    public function editReservation()
    {
        echo $this->twig->render("admin/edit_reservation.html.twig");
    }

    public function deleteReservation()
    {
        echo $this->twig->render("admin/delete_reservation.html.twig");
    }

// 🔹 Gestion des bénéficiaires
    public function adminBeneficiaires()
    {
        echo $this->twig->render("admin/beneficiaire_list.html.twig");
    }

    public function editBeneficiaire()
    {
        echo $this->twig->render("admin/edit_beneficiaire.html.twig");
    }

    public function deleteBeneficiaire()
    {
        echo $this->twig->render("admin/delete_beneficiaire.html.twig");
    }

// 🔹 Gestion des administrateurs
    public function adminList()
    {
        echo $this->twig->render("admin/admin_list.html.twig");
    }

    public function deleteAdmin()
    {
        echo $this->twig->render("admin/delete_admin.html.twig");
    }

}
