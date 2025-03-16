<?php
declare (strict_types = 1);

namespace MyApp\Controller;

use MyApp\Entity\Administrateur;
use MyApp\Model\AdministrateurModel;
use MyApp\Service\DependencyContainer;
use Twig\Environment;

session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: /admin/login");
    exit;
}

class AdministrateurController
{
    private $twig;
    private AdministrateurModel $administrateurModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->administrateurModel = $dependencyContainer->get('AdministrateurModel');
    }

    // 🔹 Liste des administrateurs
    public function listAdministrateurs()
    {
        $administrateurs = $this->administrateurModel->getAllAdministrateurs();
        echo $this->twig->render('administrateurController/listAdministrateurs.html.twig', ['administrateurs' => $administrateurs]);
    }

    // 🔹 Ajouter un administrateur
    public function addAdministrateur()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if (!empty($nom) && !empty($identifiant) && !empty($password)) {
                $administrateur = new Administrateur(null, $nom, $identifiant, $password);
                $this->administrateurModel->createAdministrateur($administrateur);
                header('Location: index.php?page=list-administrateurs');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        }

        echo $this->twig->render('administrateurController/addAdministrateur.html.twig');
    }

    // 🔹 Modifier un administrateur
    public function updateAdministrateur()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $identifiant = filter_input(INPUT_POST, 'identifiant', FILTER_SANITIZE_STRING);

            if (!empty($id) && !empty($nom) && !empty($identifiant)) {
                $administrateur = new Administrateur($id, $nom, $identifiant, '');
                $this->administrateurModel->updateAdministrateur($administrateur);
                header('Location: index.php?page=list-administrateurs');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $administrateur = $this->administrateurModel->getOneAdministrateur($id);
            echo $this->twig->render('administrateurController/updateAdministrateur.html.twig', ['administrateur' => $administrateur]);
        }
    }

    // 🔹 Supprimer un administrateur
    public function deleteAdministrateur()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->administrateurModel->deleteAdministrateur($id);
        header('Location: index.php?page=list-administrateurs');
    }

    // 🔹 Afficher les détails d'un administrateur
    public function showAdministrateurDetails()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $administrateur = $this->administrateurModel->getOneAdministrateur($id);
        echo $this->twig->render('administrateurController/showAdministrateurDetails.html.twig', ['administrateur' => $administrateur]);
    }

    public function registerAdmin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST["nom"];
            $identifiant = $_POST["identifiant"];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

            // Vérifier si l'identifiant existe déjà
            $stmt = $this->db->prepare("SELECT * FROM Administrateur WHERE identifiant = :identifiant");
            $stmt->execute(["identifiant" => $identifiant]);
            if ($stmt->fetch()) {
                echo "Cet identifiant est déjà utilisé.";
                return;
            }

            // Insérer l’administrateur
            $stmt = $this->db->prepare("INSERT INTO Administrateur (Nom, identifiant, password) VALUES (:nom, :identifiant, :password)");
            $stmt->execute(["nom" => $nom, "identifiant" => $identifiant, "password" => $password]);

            echo "Administrateur enregistré avec succès.";
        }
    }
    public function loginAdmin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $identifiant = $_POST["identifiant"];
            $password = $_POST["password"];

            // Récupérer l'admin en base
            $stmt = $this->db->prepare("SELECT * FROM Administrateur WHERE identifiant = :identifiant");
            $stmt->execute(["identifiant" => $identifiant]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier le mot de passe
            if ($admin && password_verify($password, $admin["password"])) {
                session_start();
                $_SESSION["admin"] = $admin["identifiant"];
                header("Location: /admin/dashboard");
            } else {
                echo "Identifiant ou mot de passe incorrect.";
            }
        }
    }

}
