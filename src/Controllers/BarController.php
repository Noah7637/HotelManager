<?php

namespace MVC\Controllers;

use MVC\Models\BarManager;
use MVC\Validator;

class BarController
{
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct() {
        $this->manager = new BarManager();
        $this->validator = new Validator();
    }

    // Affichage de la page bar avec les commandes et les boissons par bar
    public function index()
    {
        // Récupération des commandes clients et des bars
        $commandes = $this->manager->getClientBoisson();
        $bars = $this->manager->getBar();

        // Récupération des boissons pour chaque bar
        $boissonsBar = [];
        foreach ($bars as $bar) {
            $boissonsBar[$bar->getIdBar()] = $this->manager->getBoissonBar($bar->getIdBar());
        }

        // Chargement de la vue
        require VIEWS . 'App/bar.php';
    }

}