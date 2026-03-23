<?php

namespace MVC\Models;

use MVC\Models\Restaurant;

class RestaurantManager
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

    // Récupération de tous les menus
    public function getAll()
    {
        $stmt = $this->bdd->query("SELECT id_menu, name AS menu_name, description, prix_un FROM menu");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Restaurant");

        return $stmt->fetchAll();
    }

    // Récupération de tous les restaurants
    public function getRestos()
    {
        $stmt = $this->bdd->query("SELECT * FROM restaurant");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Restaurant");

        return $stmt->fetchAll();
    }

    // Récupération du détail d'un menu avec son restaurant associé
    public function show($id)
    {
        $stmt = $this->bdd->prepare("SELECT m.*, r.* FROM menu m LEFT JOIN restaurant_menu rm ON m.id_menu = rm.id_menu LEFT JOIN restaurant r ON r.id_restaurant = rm.id_restaurant WHERE m.id_menu = ?");

        $stmt->execute([$id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\Restaurant");

        return $stmt->fetchAll();
    }

    // Suppression d'un menu par son id
    public function delete($id)
    {
        $stmt = $this->bdd->prepare("DELETE FROM menu WHERE id_menu = ?");

        return $stmt->execute([$id]);
    }

    // Création d'un menu et association aux restaurants sélectionnés
    public function create()
    {
        // Insertion du menu en base de données
        $stmt = $this->bdd->prepare("INSERT INTO menu (name, description, prix_un) VALUES (?, ?, ?)");
        $stmt->execute([
            $_POST['nom'],
            $_POST['description'],
            $_POST['prix']
        ]);

        // Récupération de l'id du menu nouvellement créé
        $id_menu = $this->bdd->lastInsertId();

        // Association du menu aux restaurants sélectionnés
        if (!empty($_POST['restaurants'])) {
            $stmt2 = $this->bdd->prepare("INSERT IGNORE INTO restaurant_menu (id_restaurant, id_menu) VALUES (?, ?)");
            foreach ($_POST['restaurants'] as $id_restaurant) {
                $stmt2->execute([$id_restaurant, $id_menu]);
            }
        }
    }

}