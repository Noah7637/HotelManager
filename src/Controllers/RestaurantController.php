<?php

namespace MVC\Controllers;

use MVC\Models\RestaurantManager;
use MVC\Validator;

class RestaurantController
{
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct()
    {
        $this->manager = new RestaurantManager();
        $this->validator = new Validator();
    }

    // Affichage de la page avec la liste de tous les menus
    public function index()
    {
        // Récupération de tous les menus
        $menus = $this->manager->getAll();

        // Chargement de la vue
        require VIEWS . 'App/restaurant.php';
    }

    // Affichage du détail d'un menu par son id
    public function affiche($id)
    {
        // Récupération du menu correspondant à l'id
        $solo = $this->manager->show($id);

        // Chargement de la vue
        require VIEWS . 'App/menu.php';
    }

    // Suppression d'un menu et redirection
    public function delete($id)
    {
        // Suppression du menu en base de données
        $this->manager->delete($id);

        // Redirection vers la liste des menus
        header("Location: /restaurant");
        exit;
    }

    // Insertion d'un nouveau menu et redirection
    public function insert()
    {
        // Création du menu en base de données
        $this->manager->create();

        // Redirection vers la liste des menus
        header("Location: /restaurant");
        exit;
    }

    // Affichage du formulaire de création d'un menu
    public function create()
    {
        // Récupération des restaurants pour le formulaire
        $restos = $this->manager->getRestos();

        // Chargement de la vue
        require VIEWS . 'App/menu_add.php';
    }

}