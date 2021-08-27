<?php
// Cette classe est abstract, elle ne va jamais etre instanciée
// Chaque classe du modèle va étendre directement cette classe Model (par héritage)
// L'intérêt premier de cette classe est de partager des propriétés et des méthodes avec avec toutes les classes filles,
// c'est à dire toutes les classes qui vont hériter de la classe "Model"
// Dans notre cas, c'est l'accès à la base de données via PDO qu'on va partager entre toutes les classes filles.
// Et pour optimiser cet accès à la base de données, nous allons mettre en oeuvre le design pattern singleton
// qui consiste à ne définir qu'une seule et unique instance de PDO, partagées entre toutes les instances des classes
// filles de Model.
// Lien utile: https://apprendre-php.com/tutoriels/tutoriel-45-singleton-instance-unique-d-une-classe.html


abstract class Model
{

    // à compléter avec les infos de votre base de données
    private const HOST = 'localhost';
    private const DB = 'mvc';
    private const USER = 'root';
    private const PWD = '';

    /* singleton */
    private static $database; //on le met en static pour qu'il soit partagé avec toutes les instances des
    // classes qui heriteront de la class Model (classes filles de Model)

    /**
     * Cette fonction sera appellée par getDatabase() la premiere fois pour
     * initialiser la connexion avec la base de données
     */
    private static function initDatabase(){
        if (DB_MANAGER == PDO)
        {
            self::$database = new PDO('mysql:host='. self::HOST . ';dbname='. self::DB,
                self::USER,
                self::PWD,
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );
            //gestion des erreurs
            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        else if (DB_MANAGER == MEDOO)
        {
            self::$database = new Medoo\Medoo([
                'database_type' => 'mysql',
                'database_name' => self::DB,
                'server' => self::HOST,
                'username' => self::USER,
                'password' => self::PWD,
                "charset" => "utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        }
    }

    //design pattern singleton
    protected function getDatabase()
    {
        // la premiere fois on initialise self::$database
        if (self::$database === null) {
            self::initDatabase();
        }
        // et on renvoie l'objet qui sert à effectuer les requêtes
        return self::$database;
    }
}
