<?php

namespace MVC\Models;

use MVC\Models\Home;

class HomeManager
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

    // Récupération des statistiques générales : total des factures, nombre de clients, chambres occupées et total des chambres
    public function getAll()
    {
        $stmt = $this->bdd->query("SELECT (SELECT SUM(total_ttc) FROM Facture) AS totaux, (SELECT COUNT(*) FROM Client) AS nombre_client, (SELECT COUNT(*) FROM Chambre WHERE occupe = 1) AS occupe, (SELECT COUNT(*) FROM Chambre) AS total_chambre;");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Home");

        return $stmt->fetchAll();
    }

    // Récupération des 5 dernières factures triées par date
    public function getLastFacture()
    {
        $stmt = $this->bdd->query("SELECT * FROM Facture ORDER BY date DESC LIMIT 5;");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Home");

        return $stmt->fetchAll();
    }

}