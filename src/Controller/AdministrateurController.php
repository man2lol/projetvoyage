<?php
declare (strict_types = 1);

namespace MyApp\Controller;

use MyApp\Entity\Administrateur;
use MyApp\Model\AdministrateurModel;
use MyApp\Service\DependencyContainer;
use Twig\Environment;



class AdministrateurController
{
    private $twig;
    private AdministrateurModel $administrateurModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->administrateurModel = $dependencyContainer->get('AdministrateurModel');
    }

    
    public function listAdministrateurs()
    {
        $administrateurs = $this->administrateurModel->getAllAdministrateurs();
        echo $this->twig->render('administrateurController/listAdministrateurs.html.twig', ['administrateurs' => $administrateurs]);
    }

  
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

   
    public function deleteAdministrateur()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->administrateurModel->deleteAdministrateur($id);
        header('Location: index.php?page=list-administrateurs');
    }

   
    public function showAdministrateurDetails()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $administrateur = $this->administrateurModel->getOneAdministrateur($id);
        echo $this->twig->render('administrateurController/showAdministrateurDetails.html.twig', ['administrateur' => $administrateur]);
    }

    

}