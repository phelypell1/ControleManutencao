<?php
    session_start();
    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }

    require_once('../Connections/Conexao.php');
    $id = filter_input(INPUT_POST, 'campo_cod', FILTER_SANITIZE_STRING);
    //variaveis//
    $campo_tipo = filter_input(INPUT_POST, 'campo_tipo', FILTER_SANITIZE_STRING);
    $campo_imei = filter_input(INPUT_POST, 'campo_imei', FILTER_SANITIZE_STRING);
    $campo_sut = filter_input(INPUT_POST, 'campo_sut', FILTER_SANITIZE_STRING);
    $campo_patrimonio = filter_input(INPUT_POST, 'campo_patrimonio', FILTER_SANITIZE_STRING);
    $campo_entrada = filter_input(INPUT_POST, 'campo_entrada', FILTER_SANITIZE_STRING);
    $campo_origem = filter_input(INPUT_POST, 'campo_origem', FILTER_SANITIZE_STRING);
    $campo_departamento = filter_input(INPUT_POST, 'campo_departamento', FILTER_SANITIZE_STRING);
    $campo_descDefeito = filter_input(INPUT_POST, 'campo_descDefeito', FILTER_SANITIZE_STRING);
    $campo_status = filter_input(INPUT_POST, 'campo_Status', FILTER_SANITIZE_STRING);
    $txt_tipoRegistro = filter_input(INPUT_POST, 'tipoRegistro', FILTER_SANITIZE_STRING);
    $txt_status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    
    ////////Parte 
    
//////////////////////////////////////////////////////////////////////////////////////////////////
    
//Session Para trazer dados do usuário//
    $nome = $_SESSION['username'];
    //convert data
    $data = date('Y-m-d h:m:s');

    if($campo_tipo == '--Selecione--' || $campo_tipo == '' || $campo_patrimonio == '' || $campo_entrada == ''
    || $campo_entrada == '' || $campo_origem == '' || $campo_departamento == '' || $campo_descDefeito == '' || $campo_status == '--Selecione--'
    || $txt_tipoRegistro == '' || $txt_status == ''){
       echo 'Atenção preenchas os campos';
        die();
    }
    
    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();
    /*$sql = "update CadastroOs (tipoEquipamento, IMEI, SUT, patrimonio, descricaoDefeito, dataEntrada, tecnicoRecebimento, origem, departamento, statuOs, tipoReparo, osStatus)";
    $sql.="values('$campo_tipo', '$campo_imei', '$campo_sut', '$campo_patrimonio', '$campo_descDefeito', '$data', 
    '$nome', '$campo_origem', '$campo_departamento','$campo_status', '$txt_tipoRegistro','$txt_status')";*/

    $sql = "update CadastroOs set tipoEquipamento = '$campo_tipo', IMEI = '$campo_imei', SUT = '$campo_sut',
    patrimonio = '$campo_patrimonio', descricaoDefeito = '$campo_descDefeito', dataEntrada = '$data', 
    tecnicoRecebimento = '$nome', origem = '$campo_origem' , departamento = '$campo_departamento', 
    statuOs = '$campo_status', tipoReparo = '$txt_tipoRegistro', osStatus = '$txt_status' where idOs = '$id'";


    if(mysqli_query($link,$sql)){
        echo 'Atenção ! O registro '.$id.' teve seus dados atualizados';
    }else{
        echo 'ERRO AO CADASTRAR! <br> CODIGO ERRO: '.mysqli_error($link);
    }

?>