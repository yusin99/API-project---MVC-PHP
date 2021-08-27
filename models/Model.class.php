<?php
abstract class Model
{
    private const HOST = 'localhost';
    private const DB = 'mvc';
    private const USER = 'root';
    private const PWD = '';

    
    private static $database; 
    private static function initDatabase(){
        if (DB_MANAGER == PDO)
        {
            self::$database = new PDO('mysql:host='. self::HOST . ';dbname='. self::DB,
                self::USER,
                self::PWD,
                [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
            );
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
    protected function getDatabase()
    {

        if (self::$database === null) {
            self::initDatabase();
        }
      
        return self::$database;
    }
}