<?php
namespace controller;

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
            echo "
        <script>
            window.alert('dados do Formulario vazio')
            window.location.href='../Templates/register.html'
        </script>";
        } else {
             $obj = new UserController();
             $resnome = $obj->validateName($data['name']);
             $resemail = $obj->validateEmail($data['email']);
             $rescidade  = $obj->validateCidade($data['cidade']);
             $resestado = $obj->validateEstado($data['estado']);
        
             echo $resnome, $resemail;
             var_dump($rescidade);
             var_dump($resestado);
        }
    }





    private function validateName($data)
    {  
        $nome = $data;
        if (!preg_match("/^[a-zA-Z ]+$/", $nome)) {
           $respom = "<script>
                window.alert('O nome deve conter apenas letras e espaços.')
                window.location.href='../Templates/register.html'
                </script>
           ";
           return $respom;
        }
        if (strlen($nome) < 2 || strlen($nome) > 50) {
            $respom = "  
            <script>
            window.alert('O nome deve ter entre 2 e 50 caracteres.')
            window.location.href='../Templates/register.html'
            </script>
            ";
            return $respom;
        }
        return $nome;
    }

    private function validateEmail($data)
    {
        $email = trim($data);

         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $respom = "<script>
            window.alert('O Email não é valido ')
            window.location.href='../Templates/register.html'
            </script>";
            return $respom;
        }
        return $email;
    }

    
    function validateCidade($data) {
        $cidade = $data;
        if (strlen($cidade) < 2 || strlen($cidade) > 60) {
            $respom = "  
            <script>
            window.alert('A cidade deve ter entre 2 e 60 caracteres.')
            window.location.href='../Templates/register.html'
            </script>
            ";
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
                return $respom;  
            }
        }
        $respom = "<script>
        window.alert('Cidade não encontrada ')
        window.location.href='../Templates/register.html'
        </script>";
        return $respom;
       
    }
    
  

    private function validateEstado($data)
    {
        $estado = $data;

        if (strlen($estado) < 2 || strlen($estado) > 60) {

            $respom = "  
            <script>
            window.alert('O Estado deve ter entre 2 e 60 caracteres.')
            window.location.href='../Templates/register.html'
            </script>
            ";
            return $respom;
        }

        $url  = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $reponse = curl_exec($ch);
        curl_close($ch);
        $estados = json_decode($reponse, true);
        foreach ($estados as $uf){
            if (strcasecmp($uf['nome'],$estado) == 0){
                $respom = $uf['nome'];
                return $respom;
            }
        }
        $respom = "<script>
        window.alert('Estado não encontrado')
        window.location.href='../Templates/register.html'
        </script>";
        return $respom;
    }

    private function validateSenha($senha)
    {
        
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


