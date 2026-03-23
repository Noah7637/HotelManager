<?php
namespace MVC\Models;

class Restaurant {

    // Propriétés liées au restaurant
    private $id_restaurant;
    private $name;

    // Propriétés liées aux menus
    private $id_menu;
    private $menu_name;
    private $description;
    private $image;
    private $prix_un;

    // Getters

    // Restaurant
    public function getIdRestaurant() {
        return $this->id_restaurant;
    }

    public function getName() {
        return $this->name;
    }

    // Menus
    public function getIdMenu() {
        return $this->id_menu;
    }

    public function getMenuName() {
        return $this->menu_name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrixUn() {
        return $this->prix_un;
    }

    public function getImage() {
        return $this->image;
    }

    // Setters

    // Restaurant
    public function setIdRestaurant() {
        $this->id_restaurant = uniqid();
    }

    public function setAdmin($name) {
        $this->name = $name;
    }

    // Menus
    public function setIdMenu($id_menu) {
        $this->id_menu = $id_menu;
    }

    public function setMenuName($menu_name) {
        $this->menu_name = $menu_name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setPrixUn($prix_un) {
        $this->prix_un = $prix_un;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}