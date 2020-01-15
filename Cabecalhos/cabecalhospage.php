<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('Location: login.php?erro=1');
    }
    header("Refresh:240");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FRControl</title>
    <script src="../jquery/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../PageStyle/styleHome.css">
    <link rel="stylesheet" href="../PageStyle/cabecalho.css">
    <script src="../scripts/jquery-3.4.1.js"></script>
</head>
<body>
    <nav class="cabecalho">
    <div class="dropdown position-menu">
            <img src="../imagens/user.png" class="img dropbtn" alt="">
            <div class="dropdown-content">
                <a href="#"><?=$_SESSION['username']?></a>
                <hr>
                <a href="#">Meus dados</a>
                <hr>
                <a href="#">Alterar senha</a>
                <hr>
                <a href="../Views/logoutHome.php">Logout</a>
            </div>
        </div>

        <a href="home.php" class="logoImg"><img src="../imagens/home-logo.png" class="imagem-logo" alt=""></a>
        <input type="search" class="input-form">
        <button class="btnbusca" type="submit"><img src="../imagens/lupa.png" class="lupaconf" alt=""></button>
    
        <div class="dropdown position-menus">
            <!--<img src="../imagens/user.png" class="img dropbtn" alt="">-->
            <a href="">Cadastros</a>
            <div class="dropdown-content">
                <a href="../Views/CadastroProduto.php">Produtos</a>
                <a href="../Cadastros/cadastro_pecas.php">Peças</a>
                <!--<hr>
                <a href="#">Teste 3</a>-->
            </div>
        </div>

        <div class="dropdown position-menus1">
            <!--<img src="../imagens/user.png" class="img dropbtn" alt="">-->
            <a href="">Estoques</a>
            <div class="dropdown-content">
                <a href="../Views/listaestoque.php">Estoque</a>
               
            </div>
        </div>
    </nav>