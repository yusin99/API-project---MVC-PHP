<?php
require_once '../models/DB.class.php';

class API extends DB
{
    public function loadTowns()
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france ORDER BY code_postal");
        $req->execute();
        $villes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);

    }

    public function loadDepartement($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE departement = ? ORDER BY code_postal");
        $req->execute([$zip]);
        $villes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function loadTown($zip)
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

    public function loadSurface($zip)
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

    public function load_updated_town($zip)
    {
        $req = $this->getDatabase()->prepare("SELECT * FROM villes_france WHERE code_postal LIKE ?");
        $req->execute(array($zip . "%"));
        $villes = $req->fetchAll();
        $req->closeCursor();
        return json_encode($villes, JSON_UNESCAPED_UNICODE);
    }

    public function update_town($id)
    {
        $id = $_POST['id'];
        $departement = $_POST['departement'];
        $nom = $_POST['nom'];
        $code_postal = $_POST['code_postal'];
        $canton = $_POST['canton'];
        $population = $_POST['population'];
        $densite = $_POST['densite'];
        $surface = $_POST['surface'];
        $sql = "UPDATE villes_france SET departement=:departement,nom= :nom,code_postal= :code_postal,canton= :canton,population= :population,densite= :densite,surface= :surface WHERE id= :id";

        $req = $this->getDatabase()->prepare($sql);
        $req->execute([
            ':code_postal' => $code_postal,
            ':population' => $population,
            ':id' => $id,
            ':canton' => $canton,
            ':surface' => $surface,
            ':nom' => $nom,
            ':departement' => $departement,
            ':densite' => $densite,
        ]);
        if (!$req) {
            $response = [
                'status' => 0,
                'message' => 'Failed:=> ' . $nom,
                'error' => mysqli_error($req),
            ];
        } else {
            $response = [
                'status' => 1,
                'message' => 'Successfully updated',
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}