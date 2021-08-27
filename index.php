<?php
session_start();

/***** SETTINGS/CONSTANTES *****/
// On définit les différents modes d'accès aux données
define("PDO", 1); // connexion par PDO
define("MEDOO", 0); // Connexion par Medoo
// Choix du mode de connexion
define("DB_MANAGER", PDO); // PDO ou MEDOO
// Création de deux constantes URL et FULL_URL qui pourront servir dans les controlleurs et/ou vues
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
define("FULL_URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]/{$_SERVER['REQUEST_URI']}"));

/***** REQUIRES/INCLUDES *****/
// Chargement du framework Medoo
include_once "./librairies/medoo/Medoo.php";
// on charge le fichier qui contient les fonctions supplémentaires qu'on va utiliser dans la vue
require_once "helpers/string_helper.php";
// inclusion des controllers
require_once "controllers/WelcomeController.php";
require_once "controllers/UsersController.php";
require_once "controllers/VillesController.php";

/****** ROUTING *********/
//réalisation du système de routage
// le fichier .htccess effectue une redirection automatique depuis l'url /nom_de_la_route vers index.php?page=nom_de_la_route
// on va donc gérer notre routage depuis le paramètre $_GET["page"]
try
{
    // si $_GET['page'] est vide alors on charge simplement la page d'index
    if (empty($_GET['page'])) {
        $controller = new WelcomeController();
        $controller->index();
    } else // sinon on traite au cas par cas nos routes
    {

        // on décompose le paramètre $_GET['page'] d'après le "/"
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        switch ($url[0]) {
            // route "/simple"
            case "simple":
                $controller = new WelcomeController();
                $controller->simple();
                break;

            // routes "/index" ou "/home", si plusieurs routes ont le même résultat on peut les enchainer comme ça
            case "index":
            case "home":
                $controller = new WelcomeController();
                $controller->index();
                break;

            // route "/elements"
            case "elements":
                $controller = new WelcomeController();
                $controller->elements();
                break;

            // route "/generic"
            case "generic":
                $controller = new WelcomeController();
                $controller->generic();
                break;

            // route "/generic2", il s'agit du même resultat que "/generic" mais avec une
            // vue décomposée en header/navbar/footer
            case "generic2":
                $controller = new WelcomeController();
                $controller->generic2();
                break;

            // route "/testjson", par exemple réponse à un appel AJAX
            case "testjson":
                $controller = new WelcomeController();
                $controller->testjson();
                break;

            // route "/allusers", qui utilise le modèle et la base de données
            case "allusers":
                // à noter qu'ici on a fait le choix d'utiliser un autre controller
                $controller = new UsersController();
                $controller->display_all_users();
                break;

            // route "/user/(:number)", qui utilise le modèle et la base de données (exemple : /user/1)
            case "user":
                // on récupère ensuite l'id du user
                $id_user = $url[1]; // on peut rajouter des vérifications, notamment si l'id n'est pas un nombre ou si l'url est mal formée
                $controller = new UsersController();
                $controller->display_user($id_user);
                break;

            // route "/allusers", qui utilise le modèle et la base de données
            case "alltowns":
                // à noter qu'ici on a fait le choix d'utiliser un autre controller
                $controller = new VillesController();
                $controller->display_all_towns();
                break;
            case "towns":
                $code_departement = $url[1];
                if (isset($url[2])) {
                    $canton = $url[2];
                    $controller = new VillesController();
                    $controller->display_town_canton($code_departement, $canton);
                    break;
                }
            case "superficie":
                    $code_postal = $url[1];
                    $controller = new VillesController();
                    $controller->display_surface($code_postal);
                    break;
            case "ville":
            case "town":
                if (empty($url[2])) {
                    $code_postal = $url[1];
                    $controller = new VillesController();
                    $controller->display_town($code_postal);
                } else if (isset($url[2]) && $url[2] === 'update') {
                    $code_postal = $url[1];
                    $controller = new VillesController();
                    $controller->update_town($code_postal);
                }
                break;
            case "population":
                $code_postal = $url[1];
                $controller = new VillesController();
                $controller->display_population($code_postal);
                break;
            
            default:
                throw new Exception("La page n'existe pas");
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}