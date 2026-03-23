<?php
namespace MVC\Models;

class Chambres {

    // Propriétés de la chambre
    private $name;
    private $description;
    private $id_chambre;
    private $image;
    private $options;
    private $prix;
    private $occupe;
    private $categorie;

    // Getters

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getId_chambre() {
        return $this->id_chambre;
    }

    public function getImage() {
        return $this->image;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getOccupe() {
        return $this->occupe;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    // Setters

    public function setName(String $name) {
        $this->name = $name;
    }

    public function setDescription(String $description) {
        $this->description = $description;
    }

    public function setId_chambre() {
        $this->id_chambre = uniqid();
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setOptions($options) {
        $this->options = $options;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setOccupe($occupe) {
        $this->occupe = $occupe;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }
}