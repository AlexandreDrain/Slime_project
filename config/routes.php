<?php

use App\Controller\AuthController;
use App\Controller\APIController;
use App\Controller\HomeController;
use App\Controller\ProductController;
use App\Controller\UserController;

// Création de pages de base
$app->get('/', HomeController::class . ':home');
$app->get('/contact', HomeController::class . ':contact');

// Renvoi d'un JSON
$app->get('/hamac', APIController::class . ':hamac');

// Création d'un groupe de routes gérants les produits
$app->group('/produit', function () {
    // Page de la liste des produits
    $this->get('/liste', ProductController::class . ':liste');
    // Création d'une route possédant une variable
    $this->get('/{id:\d+}', ProductController::class . ':show');
    // Page de modification des produits
    // todo : créer route et méthode de contrôleur
    // Page de suppression des produits
    // todo : créer route et méthode de contrôleur
});

// Page de connexion
$app->get('/inscription', AuthController::class . ':register');
$app->get('/connection', AuthController::class . ':connect');
$app->get('/test', AuthController::class . ':test');
$app->get('/utilisateurs', UserController::class . ':liste');
