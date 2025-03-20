<?php
declare(strict_types=1);

namespace MyApp\Controller;

use MyApp\Entity\Beneficiaire;
use MyApp\Model\BeneficiaireModel;
use MyApp\Model\DetailBeneficiaireModel;
use MyApp\Service\DependencyContainer;
use Twig\Environment;



class BeneficiaireController
{
    private $twig;
    private BeneficiaireModel $beneficiaireModel;
    private DetailBeneficiaireModel $detailBeneficiaireModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->beneficiaireModel = $dependencyContainer->get('BeneficiaireModel');
        $this->detailBeneficiaireModel = $dependencyContainer->get('DetailBeneficiaireModel');
    }

   
    public function listBeneficiaires()
    {
        $beneficiaires = $this->beneficiaireModel->getAllBeneficiaires();
        echo $this->twig->render('beneficiaireController/listBeneficiaires.html.twig', ['beneficiaires' => $beneficiaires]);
    }

   
    public function addBeneficiaire()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);

            if (!empty($nom) && !empty($prenom)) {
                $beneficiaire = new Beneficiaire(null, $nom, $prenom);
                $this->beneficiaireModel->createBeneficiaire($beneficiaire);
                header('Location: index.php?page=list-beneficiaires');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        }
        echo $this->twig->render('beneficiaireController/addBeneficiaire.html.twig');
    }

  
    public function updateBeneficiaire()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);

            if (!empty($id) && !empty($nom) && !empty($prenom)) {
                $beneficiaire = new Beneficiaire($id, $nom, $prenom);
                $this->beneficiaireModel->updateBeneficiaire($beneficiaire);
                header('Location: index.php?page=list-beneficiaires');
            } else {
                $_SESSION['message'] = 'Veuillez remplir tous les champs.';
            }
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $beneficiaire = $this->beneficiaireModel->getOneBeneficiaire($id);
            echo $this->twig->render('beneficiaireController/updateBeneficiaire.html.twig', ['beneficiaire' => $beneficiaire]);
        }
    }

    public function deleteBeneficiaire()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

       
        $details = $this->detailBeneficiaireModel->getBeneficiairesByBeneficiaireId($id);
        
        if (empty($details)) {
           
            $this->beneficiaireModel->deleteBeneficiaire($id);
            header('Location: index.php?page=list-beneficiaires');
        } else {
            $_SESSION['message'] = 'Ce bénéficiaire ne peut pas être supprimé car il est lié à une réservation.';
        }
    }

   
    public function showBeneficiaireReservations()
    {
        $id_beneficiaire = filter_input(INPUT_GET, 'id_beneficiaire', FILTER_SANITIZE_NUMBER_INT);
        $beneficiaire = $this->beneficiaireModel->getOneBeneficiaire($id_beneficiaire);
        $reservations = $this->detailBeneficiaireModel->getReservationsByBeneficiaire($id_beneficiaire);

        echo $this->twig->render('beneficiaireController/showBeneficiaireReservations.html.twig', [
            'beneficiaire' => $beneficiaire,
            'reservations' => $reservations
        ]);
    }
}
