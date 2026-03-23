<?php

namespace MVC\Models;

use MVC\Models\User;

class UserManager
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

    // Recherche un utilisateur par son nom d'utilisateur
    public function find(String $username): User | false
    {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE nom = ?");
        $stmt->execute(array($username));
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "MVC\Models\User");

        return $stmt->fetch();
    }

    // Récupération de tous les utilisateurs
    public function all()
    {
        $stmt = $this->bdd->query('SELECT * FROM Users');

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "MVC\Models\User");
    }

    // Insertion d'un nouvel utilisateur en base de données
    public function store($password)
    {
        $stmt = $this->bdd->prepare("INSERT INTO Users(nom, password, role) VALUES (?, ?, ?)");
        $stmt->execute(array(
            $_POST["username"],
            $password,
            0
        ));
    }

    // Récupération de tous les utilisateurs triés par id
    public function getAllUsers()
    {
        $stmt = $this->bdd->prepare("SELECT * FROM users ORDER BY id_user ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Recherche un utilisateur par son id
    public function findById($id)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    // Mise à jour du statut admin d'un utilisateur
    public function updateAdminStatus($userId, $status)
    {
        $stmt = $this->bdd->prepare("UPDATE users SET admin = ? WHERE id_user = ?");

        return $stmt->execute([$status, $userId]);
    }
}