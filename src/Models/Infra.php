<?php
namespace MVC\Models;

class Infra {

    // Propriétés liées à la piscine
    private $id_piscine;
    private $name_piscine;
    private $description_piscine;
    private $image_piscine;
    private $ouverture;
    private $fermeture;
    private $nettoyage;

    // Propriétés liées à la salle
    private $id_salle;
    private $name_salle;
    private $description_salle;
    private $image_salle;
    private $type;
    private $options;
    private $status;

    // Getters

    // Piscine
    public function getIdPiscine() {
        return $this->id_piscine;
    }

    public function getNamePiscine() {
        return $this->name_piscine;
    }

    public function getDescriptionPiscine() {
        return $this->description_piscine;
    }

    public function getImagePiscine() {
        return $this->image_piscine;
    }

    public function getOuverture() {
        return $this->ouverture;
    }

    public function getFermeture() {
        return $this->fermeture;
    }

    public function getNettoyage() {
        return $this->nettoyage;
    }

    // Salle
    public function getIdSalle() {
        return $this->id_salle;
    }

    public function getNameSalle() {
        return $this->name_salle;
    }

    public function getDescriptionSalle() {
        return $this->description_salle;
    }

    public function getImageSalle() {
        return $this->image_salle;
    }

    public function getType() {
        return $this->type;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters

    // Piscine
    public function setIdPiscine($id_piscine) {
        $this->id_piscine = $id_piscine;
    }

    public function setNamePiscine($name_piscine) {
        $this->name_piscine = $name_piscine;
    }

    public function setDescriptionPiscine($description_piscine) {
        $this->description_piscine = $description_piscine;
    }

    public function setImagePiscine($image_piscine) {
        $this->image_piscine = $image_piscine;
    }

    public function setOuverture($ouverture) {
        $this->ouverture = $ouverture;
    }

    public function setFermeture($fermeture) {
        $this->fermeture = $fermeture;
    }

    public function setNettoyage($nettoyage) {
        $this->nettoyage = $nettoyage;
    }

    // Salle
    public function setIdSalle($id_salle) {
        $this->id_salle = $id_salle;
    }

    public function setNameSalle($name_salle) {
        $this->name_salle = $name_salle;
    }

    public function setDescriptionSalle($description_salle) {
        $this->description_salle = $description_salle;
    }

    public function setImageSalle($image_salle) {
        $this->image_salle = $image_salle;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setOption($option) {
        $this->options = $option;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}