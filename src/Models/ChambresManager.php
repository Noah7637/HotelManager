<?php

namespace MVC\Models;

use MVC\Models\Chambres;

class ChambresManager
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

    // Récupération de toutes les chambres
    public function getAll()
    {
        $stmt = $this->bdd->query("SELECT * FROM chambre");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Chambres");

        return $stmt->fetchAll();
    }

}