<?php
class Ville extends DB
{
    private $id;
    private $departement;
    private $nom;
    private $code_postal;
    private $canton;
    private $population;
    private $densite;
    private $surface;


    public function __construct($id, $departement, $nom,$code_postal,$canton,$population,$densite,$surface)
    {
        $this->id = $id ;
        $this->departement = $departement ;
        $this->nom = $nom ;
        $this->code_postal = $code_postal ;
        $this->canton = $canton ;
        $this->population = $population ;
        $this->densite = $densite ;
        $this->surface = $surface ;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param mixed $username
     */
    public function setDepartement($departement): void
    {
        $this->departement = $departement;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $password
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $password
     */
    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }
    /**
     * @return mixed
     */
    public function getCanton()
    {
        return $this->canton;
    }

    /**
     * @param mixed $password
     */
    public function setCanton($canton): void
    {
        $this->canton = $canton;
    }
    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @param mixed $password
     */
    public function setPopulation($population): void
    {
        $this->population = $population;
    }
    /**
     * @return mixed
     */
    public function getDensite()
    {
        return $this->densite;
    }

    /**
     * @param mixed $password
     */
    public function setDensite($densite): void
    {
        $this->densite = $densite;
    }
    /**
     * @return mixed
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @param mixed $password
     */
    public function setSurface($surface): void
    {
        $this->surface = $surface;
    }

}