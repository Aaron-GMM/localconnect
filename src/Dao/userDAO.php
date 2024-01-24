<?php


require_once '../../src/Model/userModel.php';
require_once 'ConnectionBD.php';
class UserDao{  
    private $conexao; 
    
 public function register(userModel $userModel){
    

    
    $response = "";

    $nome_user  =$userModel->getUsername();
    $email = $userModel->getEmail();
    $senha = $userModel->getPassword();
    $cidade = $userModel->getcidade();
    $estado  =$userModel->getEstado();
    $objcon = new ConnectionBD();
    
    $this->conexao = $objcon->getConnection();
    $query = mysqli_query(
       $this->conexao,
            "INSERT INTO user (nome,email,password ,cidade,estado)
            VALUES('$nome_user','$email','$senha','$cidade','$estado')"
        );
    if($query){
        $response = "User cadastrado";
        return $response;
    }else{
        $response = "Erro ao tentar cadastrar o usuario";
        return $response;
    }
   
}

public function login(userModel $userModel){
    $objcon = new ConnectionBD();
    $response = "";
    $email = $userModel->getEmail();
    $senha = $userModel->getPassword();
    $this->conexao = $objcon->getConnection();
    $query = mysqli_query(
        $this->conexao,
        "SELECT * FROM user WHERE email = '$email' and password = '$senha'"
    );
    if($query){
        $response = $query;
        var_dump ($response);
    }else{
        $response = "Nenhum usuario encotrado";
        return $response;
    }

}
}
