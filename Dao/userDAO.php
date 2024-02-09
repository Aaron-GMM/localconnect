<?php


require_once '../Model/userModel.php';

require_once 'ConnectionBD.php';
class UserDao
{
    private $conexao;

    public function register(userModel $userModel)
    {
        $response = "";

        $nome_user = $userModel->getUsername();
        $email = $userModel->getEmail();
        $senha = $userModel->getPassword();
        $cidade = $userModel->getcidade();
        $estado = $userModel->getEstado();
        $objcon = new ConnectionBD();

        $this->conexao = $objcon->getConnection();
        $query = mysqli_query(
            $this->conexao,
            "INSERT INTO user (nome,email,senha ,cidade,estado)
            VALUES('$nome_user','$email','$senha','$cidade','$estado')"
        );
        if ($query) {
            $response = "User Cadastrado com sucesso";
            return $response;
        } else {
            $response = "Erro ao tentar cadastrar o usuario";
            return $response;
        }

    }
    public function login(userModel $userModel)
    {
        $objcon = new ConnectionBD();
        $response = "";
        $email = $userModel->getEmail();
        $senha = $userModel->getPassword();

        $this->conexao = $objcon->getConnection();
        $queryEmail = mysqli_query($this->conexao, "SELECT email FROM user WHERE email = '$email'");

        if ($queryEmail) {
            if (mysqli_num_rows($queryEmail) > 0) {
                $query = mysqli_query($this->conexao, "SELECT * FROM user WHERE email = '$email' AND senha = '$senha'");
                if ($query) {
                    if (mysqli_num_rows($query) == 1) {
                        $response = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        return array($response[0], 1);
                    } else {
                        $response = "Senha incorreta.";
                    }
                } else {
                    $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
                }
            } else {
                $response = "Email invalido!";
            }
        } else {
            $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
        }
        return $response;

    }
    public function deleteuser()
    {
       
    }
    public function updateuser(userModel $userModel)
    {
        $response = "";
        $id_user = $userModel->getId();
        $nome_user = $userModel->getUsername();
        $email = $userModel->getEmail();
        $senha = $userModel->getPassword();
        $cidade = $userModel->getcidade();
        $estado = $userModel->getEstado();
        $objcon = new ConnectionBD();

        $this->conexao = $objcon->getConnection();
        $query = mysqli_query(
            $this->conexao,
            "UPDATE user SET nome = '$nome_user', email = '$email', senha = '$senha', cidade = '$cidade', estado = '$estado' WHERE id ='$id_user' "
        );
        if ($query) {
            $response = array("usuario atualizado com sucesso", 1);
        } else {
            $response = "Erro ao tentar atualizar o usuario";
        }
        return $response;
    }
    public function showusers()
{
    $objcon = new ConnectionBD();
    $response = array();

    $this->conexao = $objcon->getConnection();
    $query = mysqli_query(
        $this->conexao,
        "SELECT nome, cidade, estado FROM user"
    );

    if($query && mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $response[] = $row;
        }
    } else {
        $response = array("Nenhum usuário cadastrado");
    }
    mysqli_close($this->conexao);

    return $response;
}




    public function searchbyid($id)
    {
        $objcon = new ConnectionBD();

        $this->conexao = $objcon->getConnection();

        $query = mysqli_query($this->conexao, "SELECT * FROM user WHERE id = '$id' ");
        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $response = mysqli_fetch_all($query, MYSQLI_ASSOC);
            } else {
                $response = "Usuario Não encontrado";
            }
        } else {
            $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
        }
        return $response;
    }

    public function searchbyemail($email)
    {
        $objcon = new ConnectionBD();

        $this->conexao = $objcon->getConnection();

        $query = mysqli_query($this->conexao, "SELECT * FROM user WHERE email = '$email' ");
        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $response = "<script>
                                window.alert('Email existente')
                                window.location.href = '../../Templates/register.html' 
                             </script>";
            } else {
                $response = true;
            }
        } else {
            $response = "Erro ao executar a consulta: " . mysqli_error($this->conexao);
        }
        return $response;
    }



}

