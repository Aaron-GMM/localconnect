<?php
// use Aaron\Composer\Dao\UserDao;
// use Aaron\Composer\Model\userModel;
require_once 'C:\xampp\htdocs\CRUD\src\Model\userModel.php';
require_once 'C:\xampp\htdocs\CRUD\src\Dao\userDao.php';



$data = array(
    "name" => filter_input(INPUT_POST, 'name'),
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
            empty($data['name']) ||
            empty($data['email']) ||
            empty($data['cidade']) ||
            empty($data['estado']) ||
            empty($data['senha'])
        ) {
            $respom = "dados do Formulario vazio>";
            return $respom;
        } else {
            $obj = new UserController();

            $errorMessages = array();

            // Validação do nome
            $nameValidation = $this->validateName($data['name']);
            if ($nameValidation !== true) {
                $errorMessages[] = $nameValidation;
            }
    
            // Validação do email
            $emailValidation = $this->validateEmail($data['email']);
            if ($emailValidation !== true) {
                $errorMessages[] = $emailValidation;
            }
    
            // Validação da cidade
            $cidadeValidation = $this->validateCidade($data['cidade']);
            if ($cidadeValidation !== true) {
                $errorMessages[] = $cidadeValidation;
            }
    
            // Validação do estado
            $estadoValidation = $this->validateEstado($data['estado']);
            if ($estadoValidation !== true) {
                $errorMessages[] = $estadoValidation;
            }
    
            // Validação da senha
            $senhaValidation = $this->validateSenha($data['senha']);
            if ($senhaValidation !== true) {
                $errorMessages[] = $senhaValidation;
            }
    
            // Se houver mensagens de erro, imprima-as
            if (!empty($errorMessages)) {
                foreach ($errorMessages as $errorMessage) {
                    echo $errorMessage . "<br>";
                }
                return; // Encerre o método se houver erros
            }
    
            // Se não houver erros, prossiga com o registro
            $userModel = new userModel();
            $userModel->setUsername($data['name']);
            $userModel->setEmail($data['email']);
            $userModel->setcidade($data['cidade']);
            $userModel->setestado($data['estado']);
            $userModel->setPassword($data['senha']);
    
            $userDao = new UserDao();
            $userDao->register($userModel);
    

        }
    }



    private function validateName($data)
    {
        $nome = $data;
        if (!preg_match("/^[a-zA-Z ]+$/", $nome)) {
            $respom = "O nome deve conter apenas letras e espaços";
            return $respom;
        }
        if (strlen($nome) < 2 || strlen($nome) > 50) {
            $respom = "  O nome deve ter entre 2 e 50 caracteres.";
            return $respom;
        }
        return true;
    }

    private function validateEmail($data)
    {
        $email = trim($data);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $respom = "O Email não é valido ";
            return $respom;
        }
        return true;
    }

    function validateCidade($data)
    {
        $cidade = $data;
        if (strlen($cidade) < 2 || strlen($cidade) > 60) {
            $respom = "  A cidade deve ter entre 2 e 60 caracteres";
            return $respom;
        }

        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/municipios";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $cidades = json_decode($response, true);


        foreach ($cidades as $municipio) {
            if (strcasecmp($municipio['nome'], $cidade) == 0) {
                $respom = $municipio['nome'];
                return true;
            }
        }
        
            $respom = "Cidade não encontrada";
             return $respom;
        
    }

    private function validateEstado($data)
    {
        $estado = $data;

        if (strlen($estado) < 2 || strlen($estado) > 60) {

            $respom = "O Estado deve ter entre 2 e 60 caracteres";
            return $respom;
        }

        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $reponse = curl_exec($ch);
        curl_close($ch);
        $estados = json_decode($reponse, true);
        foreach ($estados as $uf) {
            if (strcasecmp($uf['nome'], $estado) == 0) {
                $respom = $uf['nome'];
                return true;
            }
        }
        return true;
    }

    private function validateSenha($data)
    {
        $senha = trim($data);

        if (strlen($senha) < 8 || strlen($senha) > 20) {
            $respom = "A senha  deve ter entre 8 e 20 caracteres.";
            return $respom;
        }
        if (strlen($senha) < 1 || !preg_match("/[A-Z]/", $senha)) {
            $respom = " A senha deve ter pelo menos 1 caractere e 1 letra maiúscula.";
            return $respom;
        }

        return true;
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


