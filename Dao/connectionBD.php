<?php
 namespace Dao;
 use Exception;
 
define("local", 'localhost');
define("user", 'root');
define('password', '');
define('db', 'localconnect');
class ConnectionDB
{
    public $conn;
    public function get_connection()
    {
        try {
            $this->conn = new \mysqli(local, user, password, db);
            if ($this->conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $this->conn->connect_error);
            }
            return $this->conn;
        } catch (Exception $e) {
            die("Erro durante a tentativa de conexão: " . $e->getMessage());
        }
    }
}

?>