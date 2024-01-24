<?php

class ConnectionBD {
    
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "localconncetion";

    public function getConnection() {
        $conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);

        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

        return $conexao;
    }
}
