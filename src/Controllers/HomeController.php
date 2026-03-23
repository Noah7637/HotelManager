<?php

namespace MVC\Controllers;

use MVC\Models\HomeManager;
use MVC\Validator;

class HomeController
{
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct()
    {
        $this->manager = new HomeManager();
        $this->validator = new Validator();
    }

    // Affichage de la page d'accueil avec les données générales
    public function index()
    {
        // Récupération de toutes les données de la page d'accueil
        $homes = $this->manager->getAll();

        // Récupération de la dernière facture
        $factures = $this->manager->getLastFacture();

        // Chargement de la vue
        require VIEWS . 'App/homepage.php';
    }

}