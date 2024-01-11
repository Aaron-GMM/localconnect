<?php

 namespace Model;


 use Dao\ConnectionDB;
 use Model\userModel;
class UserDao{  
    public $conect;
    public $userobj;
 public function register(){
    $this-> conect = new ConnectionDB;
    $this-> userobj = new userModel;
    $response = "";
    $localidade = $this->userobj->getLocalidade();

    
    $conn = $this->conect->get_connection();
    $nome_user  = mysqli_real_escape_string($conn,$this->userobj->getUsername());
    $email = mysqli_real_escape_string($conn,$this->userobj->getEmail());
    $senha = mysqli_real_escape_string($conn,$this->userobj->getPassword());
    $cidade = mysqli_real_escape_string($conn,$localidade['city']);
    $estado  = mysqli_real_escape_string($conn,$localidade['state']);
    
    $query = mysqli_query(
       $conn,
            "INSERT INTO user (nome,email,senha,info_contato,categoria)
            VALUES('$nome_user','$email','$senha','$cidade','$estado')"
        );
    if($query){
        $response = "User cadastrado";
    }else{
        $response = "Erro ao tentar cadastrar o produto";
    }
    return $response;
}
}
?>