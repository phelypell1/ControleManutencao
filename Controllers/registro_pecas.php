<?php
    session_start();
    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }
    require_once('../Connections/Conexao.php');

    //variaveis//
    $campo_select = filter_input(INPUT_POST, 'campo', FILTER_SANITIZE_NUMBER_INT);
    $campo_id = filter_input(INPUT_POST, 'campo_os', FILTER_SANITIZE_NUMBER_INT);
    $valor_id = filter_input(INPUT_POST, 'campo_valor', FILTER_SANITIZE_NUMBER_INT);
    $txt = $_POST['campo'];

    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();

    $sql = " insert into trocaPecas (osId, pecaId, precoUnit) values ('$campo_id', '$campo_select','$valor_id')";
    mysqli_query($link, $sql);
    echo $valor_id.'Cadastro Realizado com sucesso !'.mysqli_error($link);
?>