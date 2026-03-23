<?php

namespace MVC\Controllers;

use MVC\Models\InfraManager;
use MVC\Validator;

class InfraController
{
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct()
    {
        $this->manager = new InfraManager();
        $this->validator = new Validator();
    }

    // Affichage de la page infrastructure avec les piscines et les salles
    public function index()
    {
        // Récupération de toutes les piscines
        $piscines = $this->manager->getAllPiscine();

        // Récupération de toutes les salles
        $salles = $this->manager->getAllSalle();

        // Chargement de la vue
        require VIEWS . 'App/infra.php';
    }
}