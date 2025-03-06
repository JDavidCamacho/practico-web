<?php
// /negocio/UserService.php
require_once __DIR__ . '/../data/UsuarioDAO.php';

class UserService
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    //En negocio hacemos la validaciones
    public function authenticate($username, $password)
    {
        $user = $this->userDAO->getUserByUsername($username);
        //verifico si mi variable user esta trayendo un valor en el campo password
        if ($user) {
            //Verifico si el password que ingreso el usuario es igual al que obtengo de la bd
            if ($password === $user->getPassword()) {
                return true;
            }
        }
        return false;
    }

    // Método para obtener todos los usuarios
    public function getAllUsers() 
    {
        return $this->userDAO->getAllUsers();
    }

    // Método para crear usuarios
    public function createUser(User $user)
    {
        return $this->userDAO->createUser($user);
    }

    // Obtener un usuario por ID
    public function getUserById($userId)
    {
        return $this->userDAO->findUserById($userId);
    }

    // Actualizar un usuario
    public function updateUser(User $user)
    {
        // Validaciones básicas (puedes añadir más validaciones según sea necesario)
        /* if (empty($username) || empty($password)) {
            return false;
        }*/
        // Cifrar la contraseña antes de guardarla
        //$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $this->userDAO->updateUser($user);
    }

    // Eliminar un usuario
    public function deleteUser($userId)
    {
        return $this->userDAO->deleteUser($userId);
    }
}
