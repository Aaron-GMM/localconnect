<?php
namespace controller;

$data = array(
    "name" => filter_input(INPUT_POST, 'name' ),
    "email" => filter_input(INPUT_POST, 'email'),
    "cidade" => filter_input(INPUT_POST, 'cidade'),
    "estado" => filter_input(INPUT_POST, 'estado'),
    "senha" => filter_input(INPUT_POST, 'senha'),
    "formulario" => $_POST['formulario']
);
if (
    $data['name'] === false ||
    $data['email'] === false ||
    $data['cidade'] === false ||
    $data['estado'] === false ||
    $data['senha'] === false
) {
    echo "Problemas nos dados recebidos";
    die();
}
class UserController
{
    
    public function register($data)
    {
        if (
            empty($data['name']) &&
            empty($data['email']) &&
            empty($data['cidade']) &&
            empty($data['estado']) &&
            empty($data['senha'])
        ) {
        

            // dados vazio
        } else {
        //continuação da verificação
        }
    }

    private function validateName($name)
    {
        //adicionar logica de validação
        return $name;
    }

    private function validateEmail($email)
    {
        //adicionar logica de validação
        return $email;
    }

    private function validateCidade($cidade)
    {
        //adicionar logica de validação
        return $cidade;
    }

    private function validateEstado($estado)
    {
        //adicionar logica de validação
        return $estado;
    }

    private function validateSenha($senha)
    {
        //adicionar logica de validação
        return $senha;
    }
}



$obj = new UserController();
if (intval($data['formulario']) == 1) {
    $obj->register($data);

} else if (intval($data['formulario']) == 2) {
    //$obj->login($data);
} else {
    echo "Formulario nao encontrado";
}


?>