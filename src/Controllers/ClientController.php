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
    public function insert(): void
{
    $errors = [];

    if (empty($_POST['nom']))    $errors['nom']    = 'Le nom est requis.';
    if (empty($_POST['prenom'])) $errors['prenom'] = 'Le prénom est requis.';
    if (empty($_POST['mdp']) || strlen($_POST['mdp']) < 6)
                                 $errors['mdp']    = 'Minimum 6 caractères.';
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                                 $errors['email']  = 'E-mail invalide.';

    if (!empty($errors)) {
        require VIEWS . 'client/client_add.php';
        return;
    }

    try {
        $this->manager->create();
        header('Location: /client');
    } catch (\RuntimeException $e) {
        $errors['email'] = $e->getMessage();
        require VIEWS . 'App/clients_add.php';
    }
}

    // Affichage du formulaire de création d'un client
    public function create()
    {
        // $clients = $this->manager->getClients();

        // Chargement de la vue
        require VIEWS . 'App/clients_add.php';
    }

    // Affichage du détail d'un client par son id
    public function affiche($id)
    {
        // Récupération du client correspondant à l'id
        $solo = $this->manager->show($id);

        // Chargement de la vue
        require VIEWS . 'App/clients_affiche.php';
    }

    // Suppression d'un client et redirection
    public function delete($id)
    {
        // Suppression du client en base de données
        $this->manager->delete($id);

        // Redirection vers la liste des clients
        header("Location: /client");
        exit;
    }

}