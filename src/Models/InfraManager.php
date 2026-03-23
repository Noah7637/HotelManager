<?php

namespace MVC\Models;

use MVC\Models\Infra;

class InfraManager
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

    // Récupération de toutes les piscines avec leurs informations
    public function getAllPiscine()
    {
        $stmt = $this->bdd->query("SELECT id_piscine, `name` AS name_piscine, `description` AS description_piscine, `image` AS image_piscine, `ouverture`, `fermeture`, `nettoyage` FROM `piscine`");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Infra");

        return $stmt->fetchAll();
    }

    // Récupération de toutes les salles avec leur statut de réservation
    public function getAllSalle()
    {
        $stmt = $this->bdd->query("SELECT s.id_salle, s.name AS name_salle, s.description AS description_salle, s.image AS image_salle, s.type, s.options, cs.status FROM salle s LEFT JOIN client_salle cs ON s.id_salle = cs.id_salle GROUP BY s.id_salle");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Infra");

        return $stmt->fetchAll();
    }

}