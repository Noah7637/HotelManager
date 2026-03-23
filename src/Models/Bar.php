<?php
namespace MVC\Models;

class Bar {

    // Propriétés liées au bar et aux boissons
    private $id_bar;
    private $name;
    private $id_boisson;
    private $boisson_name;
    private $quantite_stock;
    private $prix_un_boisson;

    // Propriétés liées aux commandes clients
    private $client_nom;
    private $client_prenom;
    private $client_boisson_qte;
    private $client_boisson_date;
    private $prix_commande;

    // Getters

    public function getIdBar() {
        return $this->id_bar;
    }

    public function getName() {
        return $this->name;
    }

    public function getIdBoisson() {
        return $this->id_boisson;
    }

    public function getBoissonName() {
        return $this->boisson_name;
    }

    public function getQteStock() {
        return $this->quantite_stock;
    }

    public function getClientNom() {
        return $this->client_nom;
    }

    public function getClientPrenom() {
        return $this->client_prenom;
    }

    public function getClientBoissonQte() {
        return $this->client_boisson_qte;
    }

    public function getClientBoissonDate() {
        return $this->client_boisson_date;
    }

    public function getPrixUnBoisson() {
        return $this->prix_un_boisson;
    }

    public function getPrixCommande() {
        return $this->prix_commande;
    }

    // Setters

    public function setIdBar(string $id_bar) {
        $this->id_bar = $id_bar;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setIdBoisson($id_boisson) {
        $this->id_boisson = $id_boisson;
    }

    public function setBoissonName($boisson_name) {
        $this->boisson_name = $boisson_name;
    }

    public function setQteStock($quantite_stock) {
        $this->quantite_stock = $quantite_stock;
    }

    public function setClientNom($nom) {
        $this->client_nom = $nom;
    }

    public function setClientPrenom($prenom) {
        $this->client_prenom = $prenom;
    }

    public function setClientBoissonQte($qte) {
        $this->client_boisson_qte = $qte;
    }

    public function setClientBoissonDate($date) {
        $this->client_boisson_date = $date;
    }

    public function setPrixUnBoisson($prix_un_boisson) {
        $this->prix_un_boisson = $prix_un_boisson;
    }

    public function setPrixCommande($prix_commande) {
        $this->prix_commande = $prix_commande;
    }
}