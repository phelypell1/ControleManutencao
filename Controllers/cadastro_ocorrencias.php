<?php
    session_start();

    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }
    $id_resp = $_SESSION['id'];

    require_once('../Connections/Conexao.php');
    
    //variaveis//
    $campo_descricao = filter_input(INPUT_POST, 'campo_descricao', FILTER_SANITIZE_STRING);
    $campo_modelo = filter_input(INPUT_POST, 'campo_modelo', FILTER_SANITIZE_STRING);
    $campo_marca = filter_input(INPUT_POST, 'campo_marca', FILTER_SANITIZE_STRING);
    $campo_valor = filter_input(INPUT_POST, 'campo_valor', FILTER_SANITIZE_STRING);
    $campo_responsavel = filter_input(INPUT_POST, 'campo_responsavel', FILTER_SANITIZE_STRING);

    //Session Para trazer dados do usuário//
    $nome = $_SESSION['username'];
    //convert data
    $data = date('Y-m-d h:m:s');

    if($campo_descricao == '' || $campo_modelo == '' || $campo_marca == ''
    || $campo_valor == '' || $campo_responsavel == ''){
        echo'<br>';
        echo'<div class="alert alert-warning" role="alert"><p>Preencha os campos!</p></div>';
        die();
    }

    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();

    $sql = "insert into PecasManutencao (descricaoPeca, ModeloEquipamento, marcaEquipamento, valorPeca, dataEntrada, responsavelCadastro) ";
    $sql.= "values ";
    $sql.= "('$campo_descricao', '$campo_modelo', '$campo_marca', '$campo_valor', '$data', '$id_resp')";

    if(mysqli_query($link,$sql)){
        header('Location: ../Cadastros/cadastro_pecas.php?status=1');
    }else{
        header('Location: ../Cadastros/cadastro_pecas.php?status=2');
    }
?>