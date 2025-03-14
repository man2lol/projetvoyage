<?php
declare (strict_types = 1);
namespace MyApp\Controller;
use MyApp\Service\DependencyContainer;
use Twig\Environment;
use MyApp\Entity\Administrateur;
use MyApp\Entity\Beneficiaire;
use MyApp\Entity\Circuit;
use MyApp\Entity\Client;
use MyApp\Entity\DetailBeneficiaire;
use MyApp\Entity\Etape;
use MyApp\Entity\LieuAvisiter;
use MyApp\Entity\ReservationClient;

use MyApp\Model\AdministrateurModel;
use MyApp\Model\BeneficiaireModel;
use MyApp\Model\CircuitModel;
use MyApp\Model\ClientModel;
use MyApp\Model\DetailBeneficiaireModel;
use MyApp\Model\EtapeModel;
use MyApp\Model\LieuAvisiterModel;
use MyApp\Model\ReservationClientModel;



class DefaultController
{
    private  $twig;
    private  $administrateurModel;
    private  $beneficiaireModel;
    private  $circuitModel;
    private  $clientModel;
    private  $detailBeneficiaireModel;
    private  $etapeModel;
    private  $lieuAvisiterModel;
    private  $reservationClientModel;
   
    

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

    public function contact()
    {
        echo $this->twig->render('defaultController/contact.html.twig', []);
    }

    public function mentionsLegales()
    {
        echo $this->twig->render('defaultController/mentionsLegales.html.twig', []);
    }
}
