<?php


require_once 'C:\xampp\htdocs\localconnect\src\Model\userModel.php';

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
            "INSERT INTO user (nome,email,senha ,cidade,estado)
            VALUES('$nome_user','$email','$senha','$cidade','$estado')"
        );
    if($query){
        $response = true;
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
    $queryEmail = mysqli_query($this->conexao, "SELECT email FROM user WHERE email = '$email'");

    if($queryEmail){
        if(mysqli_num_rows($queryEmail) > 0){
            $query = mysqli_query($this->conexao, "SELECT * FROM user WHERE email = '$email' AND senha = '$senha'");
            if($query){
                if (mysqli_num_rows($query) == 1) {
                    $response = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    return  array($response[0],1);
                } else {
                    $response = "Senha incorreta.";
                }
            }else{
                $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
            }
        }else{
            $response = "Email invalido!";
        }
    }else{
        $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
    }
    return $response;

}
public function searchuser(){
    return;
}
public function searchbyid($id){
    $objcon = new ConnectionBD();

    $this->conexao = $objcon->getConnection();
    
            $query = mysqli_query($this->conexao, "SELECT * FROM user WHERE id = '$id' ");
            if($query){
                if (mysqli_num_rows($query) == 1) {
                    $response = mysqli_fetch_all($query, MYSQLI_ASSOC);
                } else {
                    $response = "Usuario Não encontrado";
                }
            }else{
                $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
            }
            return $response;
        }
  
          


}





