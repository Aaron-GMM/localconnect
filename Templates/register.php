<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD FLASK</title>
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
          <h1>Cadastre - <span> se </span></h1>
        </div>
        <form action="">
          <div class="formulario">
            <div>
              <label>Nome:</label>
              <input type="text" name="name">
            </div>

            <div>
              <label>Email:</label>
              <input type="email" name="email">
            </div>

            <div>
              <label>Cidade:</label>
              <input type="text" name="cidade">
            </div>
            <div>
              <label>Estado:</label>
              <input type="text" name="estado">
            </div>

            <div>
              <label>Senha:</label>
              <input type="password" name="senha">
            </div>

            <div>
              <input class="button" type="submit" value="ENVIAR">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>