<?php
require_once "DB.class.php";
require_once "Ville.class.php";

/*******
 * Class VillesManager
 * La classe VillesManager a pour vocation de gérer les objets Ville que l'applictaion va créer et manipuler
 */
class VillesManager extends DB
{
    // on conserve les users dans un tableau privé
    private $villes;

    /****
     * @param $user
     * Ajout d'un user au tableau $villes
     */
    public function addVille($ville)
    {
        $this->villes[$ville->getId()] = $ville;
    }

    //retourne un tableau
    public function getAllVilles()
    {
        return $this->villes;
    }

    public function loadAllVilles()
    {
        $villes = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/villes'));
        return $villes;
    }

    public function loadVille($code_postal)
    {
        $villes = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/ville/' . $code_postal));
        return $villes;
    }

    public function loadPopulation($code_postal)
    {
        $population = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/population/' . $code_postal));
        return $population;
    }
    public function loadSuperficie($code)
    {
        $surface = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/superficie/' . $code));
        return $surface;
    }
    public function loadDepCanton($code_dep, $canton)
    {
        $townsCanton = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/villes/' . $code_dep . "/" . $canton));
        return $townsCanton;
    }
    public function loadUVille($code_postal)
    {
        $villes = json_decode(file_get_contents('http://localhost/apiPHP/apiv2/api/ville/' . $code_postal));
        return $villes;
    }
    public function curlCall($url,$data_array){
            
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data_array));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($ch);
    echo $response;
    if(!$response){
        return false;
    }
    header('Refresh:1');
    }
}