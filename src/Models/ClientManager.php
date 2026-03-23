<?php

namespace MVC\Models;

use MVC\Models\Client;

class ClientManager
{

    private $bdd;

    // Initialisation de la connexion à la base de données
    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    // Retourne l'instance de la connexion
    public function getBdd()
    {
        return $this->bdd;
    }

    // Récupération de tous les clients
    public function getAll()
    {
        $stmt = $this->bdd->query("SELECT * FROM client");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Client");

        return $stmt->fetchAll();
    }

    // Création d'un nouveau client en base de données
    public function create()
    {
        $stmt = $this->bdd->prepare("INSERT INTO client (nom, prenom, email) VALUES (?, ?, ?)");
        $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email']
        ]);
    }

    // Récupération de tous les restaurants pour le formulaire
    public function getRestos()
    {
        $stmt = $this->bdd->query("SELECT * FROM restaurant");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Client");

        return $stmt->fetchAll();
    }

}