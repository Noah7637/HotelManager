<?php

namespace MVC\Controllers;

use MVC\Models\ChambresManager;
use MVC\Validator;

class ChambresController
{
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct() {
        $this->manager = new ChambresManager();
        $this->validator = new Validator();
    }

    // Affichage de la page avec la liste de toutes les chambres
    public function index()
    {
        // Récupération de toutes les chambres
        $chambres = $this->manager->getAll();

        // Chargement de la vue
        require VIEWS . 'App/chambres.php';
    }

}