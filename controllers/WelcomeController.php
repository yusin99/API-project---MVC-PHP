<?php

class WelcomeController
{
    public function __construct()
    {
    }

    /** fontion appelée par la route /simple */
    public function simple()
    {
        // Le controlleur peut directement "fournir" le code de la page à afficher
        ?>
        <html>
            <head>
                <style>
                    body, button {
                        font-family: "Helvetica Neue", sans-serif;
                        font-size: 36px;
                        font-weight: 200;
                        text-align: center;
                    }
                    button {
                        font-size: 18px;
                    }
                </style>
            </head>
            <body>
                <p>Mon nom est John Doe 👋</p>
                <p>Je suis développeur web freelance 💻</p>
                <p>Maîtrise totale de HTML et CSS ❤️</p>
                <p>A fond sur JavaScript 👟</p>
            </body>
        </html>
        <?php
    }


    /** fontion appelée par la route /index */
    public function index()
    {
        // il est aussi possible de charger un fichier PHP qu'on appellera une "vue"
        require_once "views/index.php";
    }

    /** fontion appelée par la route /elements */
    public function elements()
    {
        require_once "views/elements.php";
    }

    /** fontion appelée par la route /generic */
    public function generic()
    {
        require_once "views/generic.php";
    }

    /** fontion appelée par la route /generic (vues fragmentées) */
    public function generic2()
    {
        require_once "views/generic_fragmented.php";
    }

    /** fontion appelée par la route /testjson */
    public function testjson()
    {
        // si on souhaite gérer des appels AJAX, on peut directement renvoyer du JSON, sans avoir besoin d'une vue
        $result = array("name" => "toto", "age" => 31, "country" => "France") ;
        echo json_encode($result);
    }

}
