<?php

require "models/VillesManager.class.php";

class VillesController
{
    private $villesManager;

    public function __construct()
    {
        $this->villesManager = new villesManager();
        $this->villesManager->loadAllTowns();
    }
    public function display_all_towns()
    {
        $town = $this->villesManager->loadAllTowns();
        require_once "views/villes.php";
    }

    public function display_town($code_postal)
    {
        $town = $this->villesManager->loadTown($code_postal);
        require_once "views/ville.php";
    }
    public function display_population($code_postal)
    {

        $town = $this->villesManager->loadPopulation($code_postal);
        require_once "views/population.php";
    }
    public function display_surface($code_postal)
    {
        $town = $this->villesManager->loadSurface($code_postal);
        require_once "views/superficie.php";
    }
    public function display_town_canton($code_departement, $canton)
    {
        $town = $this->villesManager->loadDepCanton($code_departement, $canton);
        require_once "views/canton.php";
    }
    public function update_town($code_postal)
    {
        $town_update = $this->villesManager->load_updated_town($code_postal);
        require_once "views/update.php";
    }
}
