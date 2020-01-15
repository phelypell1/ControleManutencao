<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: home.php?erro=1');
    }

    require_once('../Connections/ConexaoUser.php');
     
    //Variaveis via post
    $campo_codigo = filter_input(INPUT_POST, 'campo_codigo', FILTER_SANITIZE_STRING);
    $campo_login = filter_input(INPUT_POST,'campo_login',FILTER_SANITIZE_STRING);
    $campo_perfil = filter_input(INPUT_POST,'campo_perfil',FILTER_SANITIZE_STRING);
    $campo_nome = filter_input(INPUT_POST,'campo_nome',FILTER_SANITIZE_STRING) ;
    $campo_ativo = filter_input(INPUT_POST,'campo_ativo',FILTER_SANITIZE_STRING);
    $campo_data = filter_input(INPUT_POST,'campo_data',FILTER_SANITIZE_STRING);
    $campo_email = filter_input(INPUT_POST,'campo_email',FILTER_SANITIZE_STRING);
    $campo_cargo = filter_input(INPUT_POST,'campo_cargo',FILTER_SANITIZE_STRING);
    $campo_regiao = filter_input(INPUT_POST,'campo_regiao',FILTER_SANITIZE_STRING);

    //A banco está preparado para receber valor Booleano 1 ou 0 codigo abaixo verifica o que está vindo se e verdadeiro 
    //ou falso, e passa o valor para 1 ou 0
    if($campo_ativo == 'Ativo'){
        $ativo = '1';
    }else{
        $ativo = '0';
    }
    //Converte a data para padrão Americano
    $data = date_format($campo_data,'%Y-%m-%d %H:%i:%s');
    $dataAlteracao = date('Y-m-d h:i:s');
    //Pega o ID do usuário
    $user_logado = $_SESSION['id'];

    if($campo_login == '' || $campo_nome == '' || $campo_email == ''){
        header('location: ../MeuDados/meus-dados.php?status=1 user_alteracao');
        die();
    }
    $ObjDB = new DBUser();
    $link = $ObjDB -> connecta_mysql();

    $sql="update Usuario set Nome ='$campo_nome', Email = '$campo_email' where IdUsuario = '$campo_codigo'";
    $query="update Login set Login = '$campo_login', DataUIAlteracao ='$dataAlteracao' where idLogin = '$campo_codigo'";

    

    if(mysqli_query($link, $sql) && mysqli_query($link, $query)){
       header('location: ../MeuDados/meus-dados.php?status=1');
    }else{
        header('location: ../MeuDados/meus-dados.php?status=2');
       //echo'Error'.mysqli_error($link);
    }

?>