<?php
namespace MVC\Models;

class Home {

    // Propriétés liées aux factures
    private $id_facture;
    private $num_reference;
    private $date;
    private $total_ttc;

    // Propriétés liées aux données générales de l'accueil
    private $totaux;
    private $nombre_client;
    private $occupe;
    private $total_chambre;

    // Getters

    // Factures
    public function getIdFacture() {
        return $this->id_facture;
    }

    public function getNumReference() {
        return $this->num_reference;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTotalTtc() {
        return $this->total_ttc;
    }

    // Accueil
    public function getTotaux() {
        return $this->totaux;
    }

    public function getNombreClient() {
        return $this->nombre_client;
    }

    public function getOccupe() {
        return $this->occupe;
    }

    public function getTotalChambre() {
        return $this->total_chambre;
    }

    // Setters

    // Factures
    public function setIdFacture($id_facture) {
        $this->id_facture = $id_facture;
    }

    public function setNumReference($num_reference) {
        $this->num_reference = $num_reference;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setTotalTtc($total_ttc) {
        $this->total_ttc = $total_ttc;
    }

    // Accueil
    public function setTotaux($totaux) {
        $this->totaux = $totaux;
    }

    public function setOccupe($occupe) {
        $this->occupe = $occupe;
    }

    public function setNombreClient($nombre_client) {
        $this->nombre_client = $nombre_client;
    }

    public function setTotalChambre($total_chambre) {
        $this->total_chambre = $total_chambre;
    }
}