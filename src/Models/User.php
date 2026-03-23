<?php
namespace MVC\Models;

class User {

    // Propriétés de l'utilisateur
    private $username;
    private $password;
    private $id_user;
    private $role;

    // Getters

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getId() {
        return $this->id_user;
    }

    public function getRole() {
        return $this->role;
    }

    // Setters

    public function setUsername(String $username) {
        $this->username = $username;
    }

    public function setPassword(String $password) {
        $this->password = $password;
    }

    public function setId() {
        $this->id_user = uniqid();
    }

    public function setAdmin($role) {
        $this->role = $role;
    }
}