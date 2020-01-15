<?php
  $nome = $_SESSION['username'];  
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../PageStyle/formulario-os.css">
    <link rel="stylesheet" href="../PageStyle/styleHome.css">
    <link rel="icon" type="imagem/png" href="../imagens/fr.png" />
    <link rel="stylesheet" href="../PageStyle/lista.css">
    <link rel="stylesheet" href="../PageStyle/fieldset.css">
    <title>Controle</title>
</head>
<body>
<nav class="navbar-fixed-top navbar-expand-lg navbar-dark bg-secondary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="../imagens/user.png" width="35">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href=""><?echo$nome?></a>
          <a class="dropdown-item" href="../MeuDados/meus-dados.php">Meus Dados</a>
          <a class="dropdown-item" href="">Alterar Senha</a>
          <hr>
          <a class="dropdown-item" href="../Views/logoutHome.php">Sair <img src="../imagens/logout.png" width="18"></a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../Views/home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cadastros
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../Views/cadastrar-os.php">Nova OS</a>
          <a class="dropdown-item" href="../Cadastros/cadastro_pecas.php">Peças</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Relatórios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../Views/lista_os.php">Entradas</a>
          <a class="dropdown-item" href="../Views/lista_pecas.php">Peças</a>
          <a class="dropdown-item" href="#">Saída</a>
          <a class="dropdown-item" href="../Views/lista_manutencao.php">Manutenção</a>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" >Sobre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" tabindex="-1" >BETA 1.0.2</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
