<?php

namespace MVC\Controllers;

use MVC\Models\ClientManager;
use MVC\Validator;

class ClientController
{
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct()
    {
        $this->manager = new ClientManager();
        $this->validator = new Validator();
    }

    // Affichage de la page avec la liste de tous les clients
    public function index()
    {
        // Récupération de tous les clients
        $clients = $this->manager->getAll();

        // Chargement de la vue
        require VIEWS . 'App/clients.php';
    }

    // Insertion d'un nouveau client et redirection
    public function insert()
    {
        // Création du client en base de données
        $this->manager->create();

        // Redirection vers la liste des clients
        header("Location: /clients");
        exit;
    }

    // Affichage du formulaire de création d'un client
    public function create()
    {
        // Récupération des restaurants pour le formulaire
        $restos = $this->manager->getRestos();

        // Chargement de la vue
        require VIEWS . 'App/clients.php';
    }

}