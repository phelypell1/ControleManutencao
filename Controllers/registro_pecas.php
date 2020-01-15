<?php
    session_start();
    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }
    require_once('../Connections/Conexao.php');

    //variaveis//
    $campo_select = filter_input(INPUT_POST, 'campo', FILTER_SANITIZE_NUMBER_INT);
    $campo_id = filter_input(INPUT_POST, 'campo_os', FILTER_SANITIZE_NUMBER_INT);
    $txt = $_POST['campo'];

    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();

    $sql = " insert into trocaPecas (osId, pecaId) values ('$campo_id', '$campo_select')";
    mysqli_query($link, $sql);

    echo 'Cadastro Realizado com sucesso !';
?>