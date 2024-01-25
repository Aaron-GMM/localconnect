<?php
require_once 'C:\xampp\htdocs\localconnect\src\Dao\userDAO.php';

session_start();
$id = $_SESSION['id'];
$userD = new UserDao();
$response = $userD->searchbyid($id);
$nome = $response[0]['nome'];
$prime = explode(' ',$nome , 2);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Localconncet</title>
  <link rel="stylesheet" href="../static/index.css">

</head>

<body>
  <header class="menu">
    <h2> Local <span>Connect</span></h2>

  </header>
  <div class="container">
    <div class="card">
      <div class="cont">
        <div>
          <h1>Bem vindo <span><?php echo $prime[0];  ?> </span></h1>
        </div>
       <div>
        <div>
            <h2>Nome</h2> <span><?php echo $response[0]['nome']  ?>  </span>
        </div>
        <div>
            <h2>Email</h2> <span><?php echo $response[0]['email'] ?></span>
        </div>
        <div>
            <h2>Cidade e Estado</h2> <span><?php echo $response[0]['cidade'] ?></span> & <span><?php echo $response[0]['estado'] ?></span>
        </div>
       

       </div>
       <div>
       <button class="button" href="#" >Atualizar</button>
        <button class="button" href="#" >Excluir</button>
       </div>
      </div>
    </div>
  </div>
</body>

</html>