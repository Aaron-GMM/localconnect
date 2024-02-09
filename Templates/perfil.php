<?php
require_once 'C:\xampp\htdocs\localconnect\src\Dao\userDAO.php';

session_start();
if (empty($_SESSION['id'])) {
  echo "";
} else {
  $id = $_SESSION['id'];
  $userD = new UserDao();
  $response = $userD->searchbyid($id);
  $nome = $response[0]['nome'];
  $prime = explode(' ', $nome, 2);
  $temperatura = $_SESSION['temp'];
  $condicao = $_SESSION['cond'];
  $umidade = $_SESSION['Umidade'];
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
      <div class="card-clima">
        <div class="conteudo">
          <div>
            <h4>Informações Climaticas<span><img src="../static/iconn/climate-change.png" alt="" width="40px"></span>
            </h4>
          </div>

          <div>
            <h4>Cidade:<span>
                <?php echo empty($response[0]['cidade']) ? "" : $response[0]['cidade']; ?>
              </span>
              <?php echo empty($temperatura) ? "" : $temperatura, "°C" ?>
            </h4>
            <h5>Condição:<span>
                <?php echo empty($condicao) ? "" : $condicao ?>
              </span></h5>
            <h5>Umidade:<span>
                <?php echo empty($umidade) ? "" : $umidade, "%" ?>
              </span></h5>
          </div>




        </div>
      </div>


      <div class="conte">
        <div>
          <h1 >Bem vindo <span>
              <?php echo empty($prime[0]) ? "Não está conectado!" : $prime[0]; ?>
            </span></h1>
        </div>

        <div>
          <div>
            <h2>Nome</h2> <span>
              <?php echo empty($response[0]['nome']) ? "" : $response[0]['nome'] ?>
            </span>
          </div>
          <div>
            <h2>Email</h2> <span>
              <?php echo empty($response[0]['email']) ? "" : $response[0]['email'] ?>
            </span>
          </div>
          <div>
            <h2>Estado</h2><span>
              <?php echo empty($response[0]['estado']) ? "" : $response[0]['estado'] ?>
            </span>
          </div>
        </div>
        <div>

          <?php if (empty($_SESSION['id'])) { ?>
            <a type="submit" class="button" href="../Templates/register.html">Cadastre-se</a>
            <a type="submit" class="button" href="../Templates/login.html">Conete-se</a>
            

          <?php } else { ?>
            <a class="button" href="../Templates/update.php">Atualizar</a>
            <a class="button" href="#">Excluir</a>
            <a class="button" href="../index.html">Voltar</a>
            <a type="submit" class="button" href="../Templates/exit.php">sair</a>

          <?php } ?>

        </div>
      </div>
    </div>

</body>

</html>