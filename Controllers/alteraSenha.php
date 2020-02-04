<?php
    require_once('../Connections/ConexaoUser.php');

    $ObjDB = new DBUser();
    $link = $ObjDB->connecta_mysql();

    $login = $_POST['campo_login'];
    $senha_atual = $_POST['campo_senha'];
    $senha_nova = $_POST['campo_confirma_senha'];
    $dataNova = date('Y-m-d H:m:s');

    if($senha_atual != $senha_nova){
        echo 'Atenção ! as senhas não batem, verifique e tente novamente!';
    }else{
        $query = "update Login set senha = '$senha_nova', DataUIAlteracao = '$date'  where Login = '$login'";
        
        $result = mysqli_query($link, $query);
        if($result){
            echo'Alteração realizada com sucesso !';
        }else{
            echo'Error ao atualizar: '.mysqli_error($link);
        }

    }

?>