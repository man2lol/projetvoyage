<?php
declare (strict_types = 1);
namespace MyApp\Controller;

use MyApp\Entity\Client;
use MyApp\Entity\Administrateur;
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
    
    public function adminCircuits()
    {
        echo $this->twig->render("CircuitController/listCircuits.html.twig");
    }

    public function addCircuit()
    {
        echo $this->twig->render("CircuitController/addCircuit.html.twig");
    }

    public function editCircuit()
    {
        echo $this->twig->render("CircuitController/updateCircuit.html.twig");
    }

    public function deleteCircuit()
    {
        echo $this->twig->render("CircuitController/showCircuit.html.twig");
    }


    public function adminClients()
    {
        echo $this->twig->render("ClientController/listClients.html.twig");
    }

    public function editClient()
    {
        echo $this->twig->render("ClientController/updateClient.html.twig");
    }

    public function deleteClient()
    {
        echo $this->twig->render("ClientController/showReservations.html.twig");
    }


    public function adminReservations()
    {
        echo $this->twig->render("ReservationController/listReservations.html.twig");
    }

    public function editReservation()
    {
        echo $this->twig->render("ReservationController/updateReservation.html.twig");
    }

    public function deleteReservation()
    {
        echo $this->twig->render("ReservationController/showReservationDetails.html.twig");
    }


    public function adminBeneficiaires()
    {
        echo $this->twig->render("BeneficiaireController/listBeneficiaires.html.twig");
    }

    public function editBeneficiaire()
    {
        echo $this->twig->render("BeneficiaireController/updateBeneficiaire.html.twig");
    }

    public function deleteBeneficiaire()
    {
        echo $this->twig->render("BeneficiaireController/showBeneficiaireReservation.html.twig");
    }


    public function adminList()
    {
        echo $this->twig->render("administrateurController/listAdministrateurs.html.twig");
    }

    public function deleteAdmin()
    {
        echo $this->twig->render("administrateurController/showAdministrateurDetails.html.twig");
    }

    public function registerAdmin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
            $identifiant = htmlspecialchars($_POST["identifiant"], ENT_QUOTES, 'UTF-8');
            $password = $_POST["password"];

            if (empty($nom) || empty($identifiant) || empty($password)) {
                $_SESSION['message'] = ' Veuillez remplir tous les champs.';
                header("Location: index.php?page=registerAdmin");
                exit;
            }

           
            $existingAdmin = $this->administrateurModel->getAdministrateurByIdentifiant($identifiant);
            if ($existingAdmin) {
                $_SESSION['message'] = ' Cet identifiant est déjà utilisé.';
                header("Location: index.php?page=registerAdmin");
                exit;
            }

            
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
           
            $administrateur = new Administrateur(null, $nom, $identifiant, $hashedPassword);
            $result = $this->administrateurModel->createAdministrateur($administrateur);

            if ($result) {
                $_SESSION['message'] = ' Inscription réussie. Veuillez vous connecter.';
                header("Location: index.php?page=loginAdmin");
                exit;
            } else {
                $_SESSION['message'] = ' Erreur lors de l\'inscription.';
                header("Location: index.php?page=registerAdmin");
                exit;
            }
        }

        echo $this->twig->render("defaultController/registerAdmin.html.twig");
    }
    public function loginAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
            $password = $_POST['password'];
    
            if (!$identifiant || !$password) {
                $_SESSION['message'] = ' Identifiant ou mot de passe erroné.';
                header('Location: index.php?page=loginAdmin');
                exit;
            }
    
           
            $admin = $this->administrateurModel->getAdministrateurByIdentifiant($identifiant);
    
            if (!$admin || !password_verify($password, $admin->getPassword())) {
                $_SESSION['message'] = ' Identifiant ou mot de passe erroné.';
                header('Location: index.php?page=loginAdmin');
                exit;
            }
    
            
            session_start();
            $_SESSION['admin'] = $admin->getIdentifiant();
            $_SESSION['admin_id'] = $admin->getIdentifiantAdmin();
            $_SESSION['message'] = ' Connexion réussie !';
    
         
    
            
            header('Location: index.php?page=home');
            exit;
        }
    
        echo $this->twig->render("defaultController/loginAdmin.html.twig");
    }
    public function logout()
    {
        session_start();
        session_destroy();
        $_SESSION = [];
        header("Location: index.php?page=home");
        exit;
    }
    public function registerClient()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = htmlspecialchars($_POST["nom"], ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($_POST["prenom"], ENT_QUOTES, 'UTF-8');
            $date_naissance = $_POST["date_naissance"];
            $identifiant = htmlspecialchars($_POST["identifiant"], ENT_QUOTES, 'UTF-8');
            $password = $_POST["password"];
    
            if (empty($nom) || empty($prenom) || empty($date_naissance) || empty($identifiant) || empty($password)) {
                $_SESSION['message'] = ' Veuillez remplir tous les champs.';
                header("Location: index.php?page=registerClient");
                exit;
            }
    
            $existingClient = $this->clientModel->getClientByIdentifiant($identifiant);
            if ($existingClient) {
                $_SESSION['message'] = ' Cet identifiant est déjà utilisé.';
                header("Location: index.php?page=registerClient");
                exit;
            }
    
            if (!strtotime($date_naissance)) {
                $_SESSION['message'] = ' La date de naissance n\'est pas valide.';
                header("Location: index.php?page=registerClient");
                exit;
            }
    
            if (strlen($password) < 8) {
                $_SESSION['message'] = ' Le mot de passe doit contenir au moins 8 caractères.';
                header("Location: index.php?page=registerClient");
                exit;
            }
    
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            $client = new Client(null, $nom, $prenom, $date_naissance, $identifiant, $hashedPassword);
            $this->clientModel->createClient($client);
    
            $_SESSION['message'] = ' Inscription réussie. Veuillez vous connecter.';
            header("Location: index.php?page=loginClient");
            exit;
        }
    
        echo $this->twig->render("defaultController/registerClient.html.twig");
    }
    
    public function loginClient()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        if (!$identifiant || !$password) {
            $_SESSION['message'] = ' Identifiant ou mot de passe erroné.';
            header('Location: index.php?page=loginClient');
            exit;
        }

      
        $client = $this->clientModel->getClientByIdentifiant($identifiant);

        if (!$client || !password_verify($password, $client->getPassword())) {
            $_SESSION['message'] = ' Identifiant ou mot de passe erroné.';
            header('Location: index.php?page=loginClient');
            exit;
        }

       
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['client'] = $client->getIdentifiant();
        $_SESSION['client_id'] = $client->getIdentifiantClient();
        $_SESSION['message'] = ' Connexion réussie !';
       
        header('Location: index.php?page=home');
        exit;
    }

    echo $this->twig->render("defaultController/loginClient.html.twig");
}


}
