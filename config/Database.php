<?php

class Database
{
    private $host = 'localhost';
    private $port = '3312'; // Puerto personalizado
    private $db_name = 'sistema_web';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Método para obtener la conexión a la base de datos
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
