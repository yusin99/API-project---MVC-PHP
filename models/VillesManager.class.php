<?php
require_once "DB.class.php";
require_once "Ville.class.php";

class VillesManager extends DB
{
    // URL_API is defined in ./index.php at the top
    private $towns;

    public function addTown($towns)
    {
        $this->towns[$towns->getId()] = $towns;
    }

    public function load_updated_town($code_postal)
    {
        $towns = json_decode(file_get_contents(URL_API . '/ville/' . $code_postal));
        return $towns;
    }
    public function curlCall($url, $data_array)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_array));
        curl_setopt($ch, CURLOPT_POST, true);
        $response = curl_exec($ch);
        if (!$response) {
            return false;
        }
        header('Refresh:1');
    }
    public function getAllTowns()
    {
        return $this->towns;
    }
    public function loadAllTowns()
    {
        $towns = json_decode(file_get_contents(URL_API . '/towns'));
        return $towns;
    }
    public function loadTown($code_postal)
    {
        $towns = json_decode(file_get_contents(URL_API . '/town/' . $code_postal));
        return $towns;
    }
    public function loadPopulation($code_postal)
    {
        $population = json_decode(file_get_contents(URL_API . '/population/' . $code_postal));
        return $population;
    }
    public function loadSurface($code)
    {
        $surface = json_decode(file_get_contents(URL_API . '/surface/' . $code));
        return $surface;
    }
    public function loadDepCanton($code_dep, $canton)
    {
        $townsCanton = json_decode(file_get_contents(URL_API . '/towns/' . $code_dep . "/" . $canton));
        return $townsCanton;
    }

}