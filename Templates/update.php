<?php
require_once '../Dao/userDAO.php';

session_start();
if (empty($_SESSION['id'])) {
  echo "";
} else {
  $id = $_SESSION['id'];
  $userD = new UserDao();
  $response = $userD->searchbyid($id);
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
          <h1>Atualizar suas <span> informações </span></h1>
        </div>
        <form action="../Controller/userController.php" method="post">
          <div class="formulario">
            <div>
              <label>Nome:</label>
              <input type="text" value='<?php echo empty($response[0]['nome'])? "": $response[0]['nome'] ?>'   name="name">
            </div>

            <div>
              <label>Email:</label>
              <input type="text" value='<?php echo empty($response[0]['email'])? "": $response[0]['email'] ?>'  name="email">
            </div>

            <div>
              <label>Cidade:</label>
              <input type="text"  value='<?php echo empty($response[0]['cidade'])? "": $response[0]['cidade'] ?>'  name="cidade">
            </div>
            <div>
              <label>Estado:</label>
              <input type="text"value='<?php echo empty($response[0]['estado'])? "": $response[0]['estado'] ?>'  name="estado">
            </div>

            <div>
              <label>Senha:</label>
              <input type="text" value='<?php echo empty($response[0]['senha'])? "": $response[0]['senha'] ?>'  name="senha">
            </div>
            <input style="display: none;" type="radio" value=3 name="formulario" checked >
            <input style="display: none;" type="radio" value='<?php echo empty($response[0]['id'])? "": $response[0]['id'] ?>' name="id" checked >

            <div style="display: flex; flex-direction: row; gap: 10px;">
              <input class="button" type="submit" value="ATUALIZAR">
              <a type="submit" class="button" href="../Templates/perfil.php">Voltar</a>
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
