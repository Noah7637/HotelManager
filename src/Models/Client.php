<?php
namespace MVC\Models;

class Client {

    // Propriétés du client
    private $nom;
    private $prenom;
    private $id_client;
    private $email;
    private $mdp;

    // Getters

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getId() {
        return $this->id_client;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }

    // Setters

    public function setNom(String $nom) {
        $this->nom = $nom;
    }

    public function setPrenom(String $prenom) {
        $this->prenom = $prenom;
    }

    public function setId() {
        $this->id_client = uniqid();
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }
}