<?php

require "models/UsersManager.class.php";


class UsersController
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UsersManager();
        // on demande au manager de charger tous les utilisateurs depuis la base de données
        $this->userManager->loadAllUsers();
    }

    /** fontion appelée par la route /allusers */
    public function display_all_users()
    {
        // on récupère le tableau des utilisateurs dans une variable $users
        $users = $this->userManager->getAllUsers() ;
        // et on charge la vue qui utilisera $users
        require_once "views/users.php";
    }
	
	/** fontion appelée par la route /user/(:number) */
    public function display_user($id_user)
    {
        // on récupère l'utilisateur depuis le manager
        $user = $this->userManager->loadUser($id_user) ;
        // et on charge la vue qui utilisera $user
        require_once "views/user.php";
    }
}
