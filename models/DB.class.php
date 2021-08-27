<?php
abstract class DB
{

    private const HOST = 'localhost';
    private const DB = 'villes_france';
    private const USER = 'root';
    private const PWD = '';

    
    private static $database; 
    private static function initDatabase(){
       
            self::$database = new PDO('mysql:host='. self::HOST . ';dbname='. self::DB,
                self::USER,
                self::PWD,
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );

            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
       
    }

    protected function getDatabase()
    {
        if (self::$database === null) {
            self::initDatabase();
        }
        return self::$database;
    }
}