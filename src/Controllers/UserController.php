<?php

namespace MVC\Controllers;

use MVC\Models\UserManager;
use MVC\Validator;

class UserController {
    private $manager;
    private $validator;

    // Initialisation du manager et du validator
    public function __construct() {
        $this->manager = new UserManager();
        $this->validator = new Validator();
    }

    // Affichage de la page de connexion
    public function showLogin() {
        require VIEWS . 'Auth/login.php';
    }

    // Affichage de la page d'inscription
    public function showRegister() {
        require VIEWS . 'Auth/register.php';
    }

    // Déconnexion de l'utilisateur et redirection vers la page de connexion
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /auth/login/');
    }

    // Inscription d'un nouvel utilisateur
    public function register() {
        // Validation des champs du formulaire
        $this->validator->validate([
            "username"      => ["required", "min:3", "alphaNum"],
            "password"      => ["required", "min:6", "alphaNum", "confirm"],
            "passwordConfirm" => ["required", "min:6", "alphaNum"]
        ]);

        // Sauvegarde des données du formulaire en session pour les réafficher en cas d'erreur
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            // Vérification si le username est déjà utilisé
            $res = $this->manager->find($_POST["username"]);

            if (empty($res)) {
                // Hashage du mot de passe et création de l'utilisateur
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->store($password);

                // Sauvegarde de l'utilisateur en session et redirection vers l'accueil
                $_SESSION["user"] = [
                    "id"       => $this->manager->getBdd()->lastInsertId(),
                    "username" => $_POST["username"],
                    "admin"    => 0
                ];
                header("Location: /");
            } else {
                // Username déjà pris, redirection avec message d'erreur
                $_SESSION["error"]['username'] = "Le username choisi est déjà utilisé !";
                header("Location: /auth/register");
            }
        } else {
            // Erreurs de validation, redirection vers le formulaire
            header("Location: /auth/register");
        }
    }

    // Connexion d'un utilisateur existant
    public function login() {
        // Validation des champs du formulaire
        $this->validator->validate([
            "username" => ["required", "min:3", "max:9", "alphaNum"],
            "password" => ["required", "min:6", "alphaNum"]
        ]);

        // Sauvegarde des données du formulaire en session pour les réafficher en cas d'erreur
        $_SESSION['old'] = $_POST;

        if (!$this->validator->errors()) {
            // Recherche de l'utilisateur en base de données
            $res = $this->manager->find($_POST["username"]);

            if ($res && password_verify($_POST['password'], $res->getPassword())) {
                // Sauvegarde de l'utilisateur en session et redirection vers l'accueil
                $_SESSION["user"] = [
                    "id_user"  => $res->getId(),
                    "username" => $res->getUsername(),
                    "role"     => $res->getRole()
                ];
                header("Location: /");
            } else {
                // Identifiants incorrects, redirection avec message d'erreur
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /auth/login");
            }
        } else {
            // Erreurs de validation, redirection vers le formulaire
            header("Location: /auth/login");
        }
    }
}