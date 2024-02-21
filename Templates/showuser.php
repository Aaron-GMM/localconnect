<?php
require_once 'C:\xampp\htdocs\localconnect\src\Dao\userDAO.php';
require_once 'C:\xampp\htdocs\localconnect\src\Controller\userController.php';

$data = array(
    "cidade" => filter_input(INPUT_POST, 'cidade'),
);


$UserDao = new UserDao();
$resposta = $UserDao->showusers();
$cidades = $UserDao->showcity();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localconncet</title>
    <link rel="stylesheet" href="../static/inde.css">

</head>

<body>
    <header class="menu">
        <h2> Local <span>Connect</span></h2>

    </header>
    <div class="container">
        <div class="card-perfil">
            <div class="cont">
                <div>
                    <h1>Usuarios <span> </span></h1>
                </div>
                <div>
                    <table>
                        <tr>
                            <th>Nome</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                        </tr>
                        <?php
                    
                            // Se não houver dados de filtro, exibe todos os usuários
                            if (empty($resposta)) {
                                echo "<tr><td colspan='3'>Sem usuários cadastrados</td></tr>";
                            } else {
                                foreach ($resposta as $userData) {
                                    echo "<tr><td>" . $userData["nome"] . "</td><td>" . $userData["cidade"] . "</td><td>" . $userData["estado"] . "</td></tr>";
                                }
                            }
                        
                        ?>
                    </table>
                </div>
                <div>
                    <a class="button" href="../index.html">Voltar</a>
                </div>
            </div>
        </div>
    </div>
 
</body>

</html>