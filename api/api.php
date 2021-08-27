<?php
require_once '../models/DB.class.php';

class API extends DB
{

    public function loadVilles()
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france ORDER BY code_postal");
        $req->execute();
        $villes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);

    }
    // Charge  les villes d'un département
    public function loadDepartement($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE departement = ? ORDER BY code_postal");
        $req->execute([$zip]);
        $villes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }
    // Charge une ville selon zip
    public function loadVille($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE code_postal LIKE ?");
        $req->execute(array($zip . "%"));
        $villes = $req->fetchAll();
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function loadPopulation($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE code_postal LIKE ?");
        $req->execute([$zip . "%"]);
        $villes = $req->fetchAll();
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function loadSuperficie($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE code_postal LIKE ?");
        $req->execute([$zip . "%"]);
        $villes = $req->fetchAll();
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function loadCanton($zipD, $zipC)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE departement = ? AND canton = ?");
        $req->execute([$zipD, $zipC]);
        $villes = $req->fetchAll();
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function loadUVille($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE code_postal LIKE ?");
        $req->execute(array($zip . "%"));
        $villes = $req->fetchAll();
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function UpdateVille($id)
    {
        $id = $_POST['id'];
        $departement = $_POST['departement'];
        $nom = $_POST['nom'];
        $code_postal = $_POST['code_postal'];
        $canton = $_POST['canton'];
        $population = $_POST['population'];
        $densite = $_POST['densite'];
        $surface = $_POST['surface'];

        // Construction de la requete SQL pour l'update
        $sql = "UPDATE villes_france SET departement=:departement,nom= :nom,code_postal= :code_postal,canton= :canton,population= :population,densite= :densite,surface= :surface WHERE id= :id";

        $req = $this->getDatabase()->prepare($sql);
        // echo $req;
        $req->execute([
            ':departement' => $departement,
            ':nom' => $nom,
            ':code_postal' => $code_postal,
            ':canton' => $canton,
            ':population' => $population,
            ':densite' => $densite,
            ':surface' => $surface,
            ':id' => $id,
        ]);

        if ($req) {
            $response = [
                'status' => 1,
                'status_message' => 'Ville mise a jour avec succes',
            ];
        } else {
            $response = [
                'status' => 0,
                'status_message' => 'Echec de la mise a jour de ' . $nom,
                'error' => mysqli_error($req),
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}