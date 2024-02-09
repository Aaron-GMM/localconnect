<?php

class ConnectionBD
{

    private $host = "localhost";
    private $usuario = "id21815086_aaronadm";
    private $senha = "AARoN091205$";
    private $banco = "id21815086_localconnect";

    public function getConnection()
    {
        $conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);

        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }

        return $conexao;
    }
}
