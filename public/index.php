<?php

session_start();

// Chargement de la configuration et des dépendances
require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

// Initialisation du routeur
$router = new MVC\Router($_SERVER["REQUEST_URI"]);

// Page d'accueil
$router->get('/', "HomeController@index");

// Clients
$router->get('/client',        "ClientController@index");
$router->get('/client/create', "ClientController@create");
$router->post('client/insert', "ClientController@insert");
$router->get('/client/:id', "ClientController@affiche");
$router->get('/client/delete/:id', "ClientController@delete");


// Infrastructure
$router->get('/infra', "InfraController@index");

// Bar
$router->get('/bar', "BarController@index");

// Chambres
$router->get('/chambres', "ChambresController@index");

// Restaurant
$router->get('/restaurant',            "RestaurantController@index");
$router->get('/restaurant/create',     "RestaurantController@create");
$router->post('restaurant/insert',     "RestaurantController@insert");
$router->get('/restaurant/:id',        "RestaurantController@affiche");
$router->get('/restaurant/delete/:id', "RestaurantController@delete");

// Authentification
$router->get('/auth/login/',    "UserController@showLogin");
$router->get('/auth/register/', "UserController@showRegister");
$router->get('/auth/logout/',   "UserController@logout");

$router->post('/auth/login/',    "UserController@login");
$router->post('/auth/register/', "UserController@register");

// Lancement du routeur
$router->run();