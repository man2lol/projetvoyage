<?php

declare (strict_types = 1);

namespace MyApp\Routing;

use MyApp\Controller\DefaultController;


use MyApp\Service\DependencyContainer;

class Router
{
    private $dependencyContainer;
    private $pageMappings;
    private $defaultPage;
    private $errorPage;

    public function __construct(DependencyContainer $dependencyContainer)
    {
        $this->dependencyContainer = $dependencyContainer;
        // Tableau contenant l'ensemble des pages (controller) de votre site
        // La clé est le mot qui sera récupéré dans la variable page de l'url
        // La valeur est un tableau composé de 2 colonnes
        // Colonne 1 : classe du contrôleur
        // Colonne 2 : nom de la méthode à appeler

        $this->pageMappings = [
            'home' => [DefaultController::class, 'home'],
            '404' => [DefaultController::class, 'error404'],
            '500' => [DefaultController::class, 'error500'],
          


            'registerAdmin' => [DefaultController::class, 'registerAdmin'],
            'adminDashboard' => [DefaultController::class, 'adminDashboard'],
            'loginAdmin' => [DefaultController::class, 'loginAdmin'],

            'logout' => [DefaultController::class, 'logout'],



            'loginClient' => [DefaultController::class, 'loginClient'],
            'registerClient' => [DefaultController::class, 'registerClient'],

            
            'voyage' => [DefaultController::class, 'voyage'],
            'detailBresil' => [DefaultController::class, 'detailBresil'],
            'detailEspagne' => [DefaultController::class, 'detailEspagne'],
            'detailEtatUnis' => [DefaultController::class, 'detailEtatUnis'],
            'detailMaroc' => [DefaultController::class, 'detailMaroc'],
            'reservationBresil' => [DefaultController::class, 'reservationBresil'],
            'reservationEspagne' => [DefaultController::class, 'reservationEspagne'],
            'reservationEtatUnis' => [DefaultController::class, 'reservationEtatUnis'],
            'reservationMaroc' => [DefaultController::class, 'reservationMaroc'],
            'reservationPackBresil' => [DefaultController::class, 'reservationPackBresil'],
            'reservationPackEspagne' => [DefaultController::class, 'reservationPackEspagne'],
            'reservationPackMaroc' => [DefaultController::class, 'reservationPackMaroc'],
            'reservationPackEtatUnis' => [DefaultController::class, 'reservationPackEtatUnis'],
            'information' => [DefaultController::class, 'information'],
            
            // Routes pour la gestion des circuits
            'adminCircuits' => [DefaultController::class, 'adminCircuits'],
            'addCircuit' => [DefaultController::class, 'addCircuit'],
            'editCircuit' => [DefaultController::class, 'editCircuit'],
            'deleteCircuit' => [DefaultController::class, 'deleteCircuit'],


            'adminClients' => [DefaultController::class, 'adminClients'],
            'editClient' => [DefaultController::class, 'editClient'],
            'deleteClient' => [DefaultController::class, 'deleteClient'],


            'adminReservations' => [DefaultController::class, 'adminReservations'],
            'editReservation' => [DefaultController::class, 'editReservation'],
            'deleteReservation' => [DefaultController::class, 'deleteReservation'],


            'adminBeneficiaires' => [DefaultController::class, 'adminBeneficiaires'],
            'editBeneficiaire' => [DefaultController::class, 'editBeneficiaire'],
            'deleteBeneficiaire' => [DefaultController::class, 'deleteBeneficiaire'],


            'adminList' => [DefaultController::class, 'adminList'],
            'deleteAdmin' => [DefaultController::class, 'deleteAdmin'],

        ];
        $this->defaultPage = 'home';
        $this->errorPage = '404';
    }

    public function route($twig)
    {
        $requestedPage = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

        // Si l'url ne contient pas la variable page, redirection vers la page d'accueil
        if (!$requestedPage) {
            $requestedPage = $this->defaultPage;
        } else {
            // Si la valeur de la page ne correspond pas à une clé du tableau associatif, redirection vers une page d'erreur
            if (!array_key_exists($requestedPage, $this->pageMappings)) {
                $requestedPage = $this->errorPage;
            }
        }

        // Récupère la ligne qui correspond à la clé comprise dans page
        $controllerInfo = $this->pageMappings[$requestedPage];
        /* Destructuration du tableau en mettant la première valeur du tableau de la ligne dans $controllerClass et la deuxième
        valeur dans $method */
        [$controllerClass, $method] = $controllerInfo;

        // Vérification de l'existence de la classe et de la méthode du contrôleur a appeler
        if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
            // Instancie la classe récupérée
            $controller = new $controllerClass($twig, $this->dependencyContainer);
            //la fonction call_user_func appelle une méthode sur un objet
            call_user_func([$controller, $method]);
        } else {
            // Si la classe ou la méthode n'existe pas, utilisez le contrôleur d'erreur 500
            $error500Info = $this->pageMappings['500'];
            [$errorControllerClass, $errorMethod] = $error500Info;
            $errorController = new $errorControllerClass($twig, $this->dependencyContainer);
            call_user_func([$errorController, $errorMethod]);
        }
    }
}
