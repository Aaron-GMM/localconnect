<?php
require_once 'C:\xampp\htdocs\localconnect\src\Dao\userDAO.php';
require_once 'C:\xampp\htdocs\localconnect\src\Controller\userController.php';

$data = array(
    "cidade" => filter_input(INPUT_POST, 'cidade'),
);


$UserDao = new UserDao();
$resposta = $UserDao->showusers();
$cidades = $UserDao->showcity();

$objcontroller = new UserController();
$cityfilters = $objcontroller->searchcity($data);


var_dump($cityfilters);
//precisar separar os arrays de valores filtrados e valores de controles
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
                        if($cityfilters[1]===1){
                           
                                foreach ($cityfilters as $cityfilters) {
                                    //echo "<tr><td>" . $cityfilters[0]["nome"] . "</td><td>" . $cityfilters[0]["cidade"] . "</td><td>" . $cityfilters[0]["estado"] . "</td></tr>";
                                }
                            }
                        
                        ?>
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
                <?php
                $cidadesunicas = array();
                ?>
                <div>
                    <form method="POST" action="showuser.php">
                        <h2 for="">Filtrar por Cidade</h2><br>
                        <div>

                            <select class="button" name="cidade">
                                <?php foreach ($cidades as $cidade): ?>
                                    <?php
                                    if (!in_array($cidade['cidade'], $cidadesunicas)) {
                                        $cidadesunicas[] = $cidade['cidade'];

                                        ?>
                                        <option value="<?php echo $cidade['cidade']; ?>">
                                            <?php echo $cidade['cidade']; ?>
                                        </option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                            
                            <button class="button" type="submit">Fazer Consulta</button>
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