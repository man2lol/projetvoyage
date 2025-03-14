<?php
declare(strict_types=1);

namespace MyApp\Controller;

use MyApp\Model\CircuitModel;
use MyApp\Model\LieuAvisiterModel;
use MyApp\Entity\Circuit;
use MyApp\Service\DependencyContainer;
use Twig\Environment;

class CircuitController
{
    private  $twig;
    private CircuitModel $circuitModel;
    private LieuAvisiterModel $lieuAvisiterModel;

    public function __construct(Environment $twig, DependencyContainer $dependencyContainer)
    {
        $this->twig = $twig;
        $this->circuitModel = $dependencyContainer->get('CircuitModel');
        $this->lieuAvisiterModel = $dependencyContainer->get('LieuAvisiterModel');
    }

    public function listCircuits()
    {
        $circuits = $this->circuitModel->getAllCircuits();
        echo $this->twig->render('circuitController/listCircuits.html.twig', ['circuits' => $circuits]);
    }

    public function showCircuit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if (empty($id)) {
            $_SESSION['message'] = 'Identifiant du circuit manquant.';
            header('Location: index.php?page=listCircuits');
            exit();
        }

        $circuit = $this->circuitModel->getOneCircuit(intVal($id));
        if ($circuit === null) {
            $_SESSION['message'] = 'Circuit introuvable.';
            header('Location: index.php?page=listCircuits');
            exit();
        }

        $etapes = $this->circuitModel->getEtapesByCircuit(intVal($id));

        echo $this->twig->render('circuitController/showCircuit.html.twig', [
            'circuit' => $circuit,
            'etapes' => $etapes
        ]);
    }

    public function addCircuit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descriptif = filter_input(INPUT_POST, 'descriptif', FILTER_SANITIZE_STRING);
            $villeDepart = filter_input(INPUT_POST, 'villeDepart', FILTER_SANITIZE_STRING);
            $paysDepart = filter_input(INPUT_POST, 'paysDepart', FILTER_SANITIZE_STRING);
            $villeArrivee = filter_input(INPUT_POST, 'villeArrivee', FILTER_SANITIZE_STRING);
            $paysArrivee = filter_input(INPUT_POST, 'paysArrivee', FILTER_SANITIZE_STRING);
            $dateDepart = filter_input(INPUT_POST, 'dateDepart', FILTER_SANITIZE_STRING);
            $nbrPlaces = filter_input(INPUT_POST, 'nbrPlaces', FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_NUMBER_INT);
            $prixInscription = filter_input(INPUT_POST, 'prixInscription', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if (!empty($descriptif) && !empty($villeDepart) && !empty($paysDepart) && !empty($villeArrivee) && 
                !empty($paysArrivee) && !empty($dateDepart) && !empty($nbrPlaces) && !empty($duree) && !empty($prixInscription)) {

                $circuit = new Circuit(null, $descriptif, $villeDepart, $paysDepart, $villeArrivee, 
                                       $paysArrivee, $dateDepart, $nbrPlaces, $duree, $prixInscription);
                $success = $this->circuitModel->createCircuit($circuit);

                if ($success) {
                    $_SESSION['message'] = 'Circuit ajouté avec succès.';
                    header('Location: index.php?page=listCircuits');
                    exit();
                } else {
                    $_SESSION['message'] = 'Erreur lors de l’ajout.';
                }
            } else {
                $_SESSION['message'] = 'Veuillez saisir toutes les données.';
            }
        }
        echo $this->twig->render('circuitController/addCircuit.html.twig', []);
    }

    public function updateCircuit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $descriptif = filter_input(INPUT_POST, 'descriptif', FILTER_SANITIZE_STRING);
            $villeDepart = filter_input(INPUT_POST, 'villeDepart', FILTER_SANITIZE_STRING);
            $paysDepart = filter_input(INPUT_POST, 'paysDepart', FILTER_SANITIZE_STRING);
            $villeArrivee = filter_input(INPUT_POST, 'villeArrivee', FILTER_SANITIZE_STRING);
            $paysArrivee = filter_input(INPUT_POST, 'paysArrivee', FILTER_SANITIZE_STRING);
            $dateDepart = filter_input(INPUT_POST, 'dateDepart', FILTER_SANITIZE_STRING);
            $nbrPlaces = filter_input(INPUT_POST, 'nbrPlaces', FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, 'duree', FILTER_SANITIZE_NUMBER_INT);
            $prixInscription = filter_input(INPUT_POST, 'prixInscription', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if (!empty($id) && !empty($descriptif) && !empty($villeDepart) && !empty($paysDepart) && 
                !empty($villeArrivee) && !empty($paysArrivee) && !empty($dateDepart) && 
                !empty($nbrPlaces) && !empty($duree) && !empty($prixInscription)) {

                $circuit = new Circuit(intVal($id), $descriptif, $villeDepart, $paysDepart, $villeArrivee, 
                                       $paysArrivee, $dateDepart, $nbrPlaces, $duree, $prixInscription);
                $success = $this->circuitModel->updateCircuit($circuit);

                if ($success) {
                    header('Location: index.php?page=listCircuits');
                    exit();
                } else {
                    $_SESSION['message'] = 'Erreur lors de la modification.';
                }
            } else {
                $_SESSION['message'] = 'Veuillez saisir toutes les données.';
            }
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $circuit = $this->circuitModel->getOneCircuit(intVal($id));
            echo $this->twig->render('circuitController/updateCircuit.html.twig', ['circuit' => $circuit]);
        }
    }

    public function deleteCircuit()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $this->circuitModel->deleteCircuit(intVal($id));
            $_SESSION['message'] = 'Circuit supprimé avec succès.';
        }
        header('Location: index.php?page=listCircuits');
    }
}
