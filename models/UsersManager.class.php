<?php
require_once "Model.class.php";
require_once "User.class.php";

/*******
 * Class UsersManager
 * La classe UserSManager a pour vocation de gérer les objets Users que l'applictaion va créer et manipuler
 */
class UsersManager extends Model
{
    // on conserve les users dans un tableau privé
    private $users;


    /****
     * @param $user
     * Ajout d'un user au tableau $users
     */
    public function addUser($user)
    {
        $this->users[$user->getId()] = $user;
    }

    //retourne un tableau
    public function getAllUsers()
    {
        return $this->users;
    }

    // charge tous les users dans le manager
    public function loadAllUsers()
    {
        /** vous pouvez écrire les requêtes pour les différents managers de DB, ou bien vous focaliser sur celui de votre choix */
        if (DB_MANAGER == PDO) // version PDO
        {
            $req = $this->getDatabase()->prepare("SELECT * FROM users ");
            $req->execute();
            $users = $req->fetchAll(PDO::FETCH_ASSOC);
            $req->closeCursor();
        }
        else if (DB_MANAGER == MEDOO) // version MEDOO
        {
            $users = $this->getDatabase()->select("users", "*") ;
        }

        // on a récupéré tous les utilisateurs, on les ajoute au manager de users
        foreach ($users as $user) {
            $new_user = new User(
                $user['id'],
                $user['username'],
                $user['password']
            );
            $this->addUser($new_user);
        }
    }

	
	// charge un utilisateur depuis son id
    public function loadUser($id)
    {
        if (empty($this->users))
		{
			$this->getAllUsers();
		}
		return $this->users[$id];
    }
  
}
