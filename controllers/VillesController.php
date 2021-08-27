<?php

require "models/VillesManager.class.php";

class VillesController
{
    private $villesManager;

    public function __construct()
    {
        $this->villesManager = new villesManager();
        // on demande au manager de charger tous les utilisateurs depuis la base de données
        $this->villesManager->loadAllVilles();
    }

    /** fontion appelée par la route /allusers */
    public function display_all_villes()
    {
        // on récupère le tableau des utilisateurs dans une variable $users
        $ville = $this->villesManager->loadAllVilles();
        // et on charge la vue qui utilisera $users
        require_once "views/villes.php";
    }

    public function display_town($code_postal)
    {
        $villes = $this->villesManager->loadVille($code_postal);
        require_once "views/ville.php";
    }
    public function display_population($code_postal)
    {

        $ville = $this->villesManager->loadPopulation($code_postal);

        require_once "views/population.php";
    }
    public function display_superficie($code_postal)
    {

        $ville = $this->villesManager->loadSuperficie($code_postal);

        require_once "views/superficie.php";
    }
    public function display_ville_canton($code_departement, $canton)
    {
        $ville = $this->villesManager->loadDepCanton($code_departement, $canton);

        require_once "views/canton.php";
    }
    public function update_town($code_postal)
    {
        $villesU = $this->villesManager->loadUVille($code_postal);

        require_once "views/update.php";
    }
}