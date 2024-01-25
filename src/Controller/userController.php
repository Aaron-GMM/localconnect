<?php
require_once 'C:\xampp\htdocs\localconnect\src\Model\userModel.php';
require_once 'C:\xampp\htdocs\localconnect\src\Dao\userDAO.php';

session_start();

$data = array(
    "name" => filter_input(INPUT_POST, 'name'),
    "email" => filter_input(INPUT_POST, 'email'),
    "cidade" => filter_input(INPUT_POST, 'cidade'),
    "estado" => filter_input(INPUT_POST, 'estado'),
    "senha" => filter_input(INPUT_POST, 'senha'),
    "formulario" => (int) $_POST['formulario']
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
            $respom = "<script>
            window.alert('Dados Vazios');
            window.location.href = '../../Templates/register.html' ;
            </script>";
            echo $respom;
        } else {
            $obj = new UserController();

            $errorMessages = array();


            $nameValidation = $this->validateName($data['name']);
            if ($nameValidation !== true) {
                $errorMessages[] = $nameValidation;
            }


            $emailValidation = $this->validateEmail($data['email']);
            if ($emailValidation !== true) {
                $errorMessages[] = $emailValidation;
            }


            $cidadeValidation = $this->validateCidade($data['cidade']);
            if ($cidadeValidation !== true) {
                $errorMessages[] = $cidadeValidation;
            }


            $estadoValidation = $this->validateEstado($data['estado']);
            if ($estadoValidation !== true) {
                $errorMessages[] = $estadoValidation;
            }

            $senhaValidation = $this->validateSenha($data['senha']);
            if ($senhaValidation !== true) {
                $errorMessages[] = $senhaValidation;
            }


            if (!empty($errorMessages)) {
                foreach ($errorMessages as $errorMessage) {
                    echo $errorMessage . "<br>";
                }
                return;
            }


            $userModel = new userModel();
            $userModel->setUsername($data['name']);
            $userModel->setEmail($data['email']);
            $userModel->setcidade($data['cidade']);
            $userModel->setestado($data['estado']);
            $userModel->setPassword($data['senha']);

            $userDao = new UserDao();
            $register = $userDao->register($userModel);
            if ($register) {
                echo $register;
            }

        }
    }

    public function login($data)
    {
        if (empty($data['email']) || empty($data['senha'])) {
            $respom = "dados do Formulario vazio>";
            return $respom;
        } else {


            $errorMessages = array();
            $emailValidation = $this->validateEmail($data['email']);
            if ($emailValidation !== true) {
                $errorMessages[] = $emailValidation;
            }

            $senhaValidation = $this->validateSenha($data['senha']);
            if ($senhaValidation !== true) {
                $errorMessages[] = $senhaValidation;
            }

            if (!empty($errorMessages)) {
                foreach ($errorMessages as $errorMessage) {
                    echo $errorMessage . "<br>";
                }
                return;
            }

            $userModel = new userModel();
            $userModel->setEmail($data['email']);
            $userModel->setPassword($data['senha']);
            $userDao = new UserDao();
            $respom = $userDao->login($userModel);
            if ($respom[1] == 1) {
                $user = $respom[0];
                $_SESSION['id'] = $user['id'];
                echo "<script>
                window.alert('Login efetuado com sucesso');
                window.location.href = '../../Templates/perfil.php' ;
                
                </>";
            } else {

                echo "<script> window.alert('$respom[0]');</script>";
            }


        }

    }


    private function validateName($data)
    {
        $nome = $data;
        if (!preg_match("/^[a-zA-Z ]+$/", $nome)) {
            $respom = "<script>
            window.alert('O nome deve conter apenas letras e espaços');
            window.location.href = '../../Templates/register.html' ;
            </script>";
            return $respom;
        }
        if (strlen($nome) < 2 || strlen($nome) > 50) {
            $respom = "<script>
            window.alert(' O nome deve ter entre 2 e 50 caracteres.');
            window.location.href = '../../Templates/register.html' ;
            </script>";
            return $respom;
        }
        return true;
    }

    private function validateEmail($data)
    {
        $email = trim($data);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $respom = "<script>
            window.alert('O Email não é valido ');
            window.location.href = '../../Templates/register.html' ;
            </script>";
            return $respom;
        }
        return true;
    }

    function validateCidade($data)
    {
        $cidade = $data;
        if (strlen($cidade) < 2 || strlen($cidade) > 60) {
            $respom = "<script>
            window.alert('A cidade deve ter entre 2 e 60 caracteres');
            window.location.href = '../../Templates/register.html' ;
            </script>"
            ;
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

        $respom = "<script>
        window.alert('Cidade não encontrada');
        window.location.href = '../../Templates/register.html' ;
        </script>";
        return $respom;

    }

    private function validateEstado($data)
    {
        $estado = $data;

        if (strlen($estado) < 2 || strlen($estado) > 60) {
            $respom = "<script>
            window.alert('O Estado deve ter entre 2 e 60 caracteres');
            window.location.href = '../../Templates/register.html' ;
            </script>";
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
        $respom = "<script>
        window.alert('Estado não encontrada');
        window.location.href = '../../Templates/register.html' ;
        </script>";
        return $respom;
    }

    private function validateSenha($data)
    {
        $senha = trim($data);

        if (strlen($senha) < 8 || strlen($senha) > 20) {

            $respom = "<script>
            window.alert('A senha  deve ter entre 8 e 20 caracteres');
            window.location.href = '../../Templates/register.html' ;
            </script>";
            return $respom;
        }
        if (strlen($senha) < 1 || !preg_match("/[A-Z]/", $senha)) {
            $respom = "<script>
            window.alert('A senha deve ter pelo menos 1 caractere e 1 letra maiúscula');
            window.location.href = '../../Templates/register.html' ;
            </script>";
            return $respom;
        }

        return true;
    }
}

$obj = new UserController();
if (intval($data['formulario']) == 1) {
    $obj->register($data);

} else if ($data['formulario'] == 2) {
    $obj->login($data);
    $data['formulario'] = 3;

} else {
    $respom = "<script>
    window.alert('formulario não encontrado');
    window.location.href = '../../Templates/register.html' ;
    </script>";
    return $respom;
}