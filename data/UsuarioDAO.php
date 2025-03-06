<?php
// /datos/UserDAO.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/User.php';

class UserDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Método para obtener todos los usuarios
    public function getAllUsers() 
    {
        $query = "CALL GetAllUsers()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        //creacion de variable para obtener el resultado
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //nuevo codigo 28/10
        //se crea un array para obtener los resultados
        $users = [];
        
        //con foreach recorremos los resultados obtenidos y los recorremos por fila con la variable row
        foreach($result as $row){
            //la variable users almacena en forma de array los distintos usuarios
            //los cuales son creados con la clase User creado en la carpeta domain
            //para crear con la clase User enviamos parametros necesarios para crear los objetos
            $users[] = new User($row['username'], $row['password'], $row['id']);
        }

        return $users;

        //return $stmt->fetchAll(PDO::FETCH_ASSOC); //devuelve un array asociativo
    }
    
    //Metodo para obtener los datos del usuario para su validacion
    public function getUserByUsername($username)
    {
        $query = "CALL GetUserByUsername(:p_username)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':p_username', $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new User($result['username'], $result['password'], $result['id']);
        }
        return null;
        //return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    // Metodo para crear el usuario
    public function createUser(User $user) //(user $user)=
    {
        $query = "CALL CreateUser(:username, :password)";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            'username' => $user->getUsername(), //La variable user que contiene los datos de la clase User recuperamos username
            'password' => $user->getPassword() //La varibale user que contiene los datos de la clase User recuperamos password
        ]);

        /* return $stmt->execute([
            'username' => $username,
            'password' => $password // Enviar la contraseña sin encriptar
        ]); */
    }

    // Encontrar un usuario por su ID usando PDO
    public function findUserById($userId)
    {
        $query = "CALL FindUserById(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return new User($result['username'], $result['password'], $result['id']);
        }
        return null;

        //return $stmt->fetch(PDO::FETCH_ASSOC); // devuelve un array asociativo
    }

    // Actualizar un usuario en la base de datos usando PDO
    public function updateUser(User $user)
    {
        $query = "CALL UpdateUser(:id, :username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $user->getId(), PDO::PARAM_INT);
        $stmt->bindParam(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);

        return $stmt->execute(); // devuelve el resultado de la ejecución
    }

    // Eliminar un usuario por su ID
    public function deleteUser($userId)
    {
        $query = "CALL DeleteUser(:id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute(); // devuelve el resultado de la ejecución
    }
}