<?php

namespace MVC\Models;

use MVC\Models\Bar;

class BarManager
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

    // Récupération de tous les bars
    public function getBar()
    {
        $stmt = $this->bdd->query("SELECT * FROM Bar");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Bar");

        return $stmt->fetchAll();
    }

    // Récupération des boissons d'un bar avec leur prix unitaire
    public function getBoissonBar($id_bar)
    {
        $stmt = $this->bdd->prepare("SELECT bb.*, bo.name AS boisson_name, bo.prix_un AS prix_un_boisson FROM bar_boisson bb JOIN boisson bo ON bb.id_boisson = bo.id_boisson WHERE id_bar = ?");

        $stmt->execute([$id_bar]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Bar");

        return $stmt->fetchAll();
    }

    // Récupération des 2 dernières commandes de boissons par les clients
    public function getClientBoisson()
    {
        try {
            $stmt = $this->bdd->prepare("SELECT cb.id_boisson, cb.quantite AS client_boisson_qte, cb.date AS client_boisson_date, cl.nom AS client_nom, cl.prenom AS client_prenom, bo.name AS boisson_name, (SELECT bo.prix_un*cb.quantite) AS prix_commande FROM client_boisson cb JOIN client cl ON cb.id_client = cl.id_client JOIN boisson bo ON cb.id_boisson = bo.id_boisson ORDER BY cb.date DESC LIMIT 2");
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Bar");

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}