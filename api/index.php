<?php

session_start();
// url de recup la totalité
//  localhost/france -> adresse que l'utilisateur verra
// localhost/france.php?action=all -> affiche la totalité des villes
// *** url ville GET
// france/ville/{code_postal}

// ** url population GET
// france/population/{code_postal}

// ** url superficie GET
// superficie/{code_postal}

// ** url villes departement GET
// france/villes/{code_departement}

// **url villes canton GET
// villes/{code_departement}/{numero_canton}-> url pour User
// villes.php?id_departement=83&id_canton=12 -> url pour le serveur

// ** url ville update POST
// ville/{code_postal}/update

// ******* Config ******
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define("FULL_URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]/{$_SERVER['REQUEST_URI']}"));

// ******** Require/includes ********
require_once './api.php';

try {
    if ($_GET['action']) {
        $url = explode('/', filter_var($_GET['action'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case 'france':
                $controller = new API();
                echo $controller->loadVilles();
                break;
            case 'villes':
                if (!empty($url[1])) {

                    if (!empty($url[2])) {
                        $controller = new API();
                        echo $controller->loadCanton($url[1], $url[2]);
                    } else {
                        $controller = new API();
                        echo $controller->loadDepartement($url[1]);
                    }
                } else {
                    $controller = new API();
                    echo $controller->loadVilles();
                }
                break;
            case 'ville':
                if (!empty($url[1])) {
                    if (!empty($url[2]) && strtolower($url[2]) === 'update') {
                        $controller = new API();
                        $controller->loadVille($url[1]);
                        if (!empty($url[3])) {
                            $controller = new API();
                            $controller->UpdateVille($url[3]);
                        }
                    } else {
                        $controller = new API();
                        echo $controller->loadVille($url[1]);
                    }
                } else {
                    throw new Exception('Veuillez indiquer un Code Postal');
                }
                break;
            case 'population':
                if (!empty($url[1])) {
                    $controller = new API();
                    echo $controller->loadPopulation($url[1]);
                } else {
                    throw new Exception('Veuillez indiquer un Code Postal');
                }
                break;
            case 'superficie':
                if (!empty($url[1])) {
                    $controller = new API();
                    echo $controller->loadSuperficie($url[1]);
                } else {
                    throw new Exception('Veuillez indiquer un Code Postal');
                }
                break;
        }
    } else {
        echo 'Veuillez faire la bonne commande';
    }
} catch (Exception $e) {
    $erreur = [
        "message" => $e->getMessage(),
        'code' => $e->getCode(),
    ];
    print_r($erreur);
}