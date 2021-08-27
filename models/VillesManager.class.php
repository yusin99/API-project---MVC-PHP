<?php
require_once "DB.class.php";
require_once "Ville.class.php";

class VillesManager extends DB
{
    private $villes;
    public function addVille($ville)
    {
        $this->villes[$ville->getId()] = $ville;
    }
    public function getAllTowns()
    {
        return $this->villes;
    }
    public function loadAllTowns()
    {
        $towns = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/villes'));
        return $towns;
    }
    public function loadTown($code_postal)
    {
        $towns = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/ville/' . $code_postal));
        return $towns;
    }
    public function loadPopulation($code_postal)
    {
        $population = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/population/' . $code_postal));
        return $population;
    }
    public function loadSurface($code)
    {
        $surface = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/superficie/' . $code));
        return $surface;
    }
    public function loadDepCanton($code_dep, $canton)
    {
        $townsCanton = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/villes/' . $code_dep . "/" . $canton));
        return $townsCanton;
    }
    public function load_updated_town($code_postal)
    {
        $towns = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/ville/' . $code_postal));
        return $towns;
    }
    public function curlCall($url,$data_array){    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data_array));
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($ch);
    if(!$response){
        return false;
    }
    header('Refresh:1');
    }
}