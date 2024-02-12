<?php
require_once 'C:\xampp\htdocs\localconnect\src\Dao\userDAO.php';

session_start();
if (empty($_SESSION['id'])) {
    echo "";
} else {
    $UserDao = new UserDao();
    $resposta = $UserDao->showusers();
    var_dump($resposta);
}


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
                        if (empty($resposta)) {
                            echo " <tr>  Sem usuarios cadastrados </tr>";
                        } else {
                            foreach ($resposta as $resposta) {
                                echo "<tr><td>" . $resposta["nome"] . "</td><td>" . $resposta["cidade"] . "</td><td>" . $resposta["estado"] . "</td></tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
                <div>
                    <form method="POST" action="../src/Controller/userController.php">
                        <h2 for="">Filtrar por Cidade</h2><br>
                        <div>

                            <select class="button" name="cidade" id="">
                                <option value="">Quixada</option>

                            </select>
                            <input style="display: none;" type="radio" value=5 name="formulario" checked>
                            <input class="button" type="submit">
                        </div>

                    </form>
                </div>
                <div>
                    <a class="button" href="../index.html">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>