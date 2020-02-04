<?php
    session_start();
    $iduser = $_SESSION['id'];

    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }

    require_once('../Connections/Conexao.php');
    
    //variaveis//
    $campo_id = filter_input(INPUT_POST, 'campo_idOs', FILTER_SANITIZE_STRING);
    $campo_tipo = filter_input(INPUT_POST, 'campo_tipo', FILTER_SANITIZE_STRING);
    $campo_imei = filter_input(INPUT_POST, 'campo_imei', FILTER_SANITIZE_STRING);
    $campo_sut = filter_input(INPUT_POST, 'campo_sut', FILTER_SANITIZE_STRING);
    $campo_patrimonio = filter_input(INPUT_POST, 'campo_patrimonio', FILTER_SANITIZE_STRING);
    $campo_entrada = filter_input(INPUT_POST, 'campo_entrada', FILTER_SANITIZE_STRING);
    $campo_origem = filter_input(INPUT_POST, 'campo_origem', FILTER_SANITIZE_STRING);
    $campo_departamento = filter_input(INPUT_POST, 'campo_departamento', FILTER_SANITIZE_STRING);
    $campo_descDefeito = filter_input(INPUT_POST, 'campo_descDefeito', FILTER_SANITIZE_STRING);
    $txt_descresolucao = filter_input(INPUT_POST, 'campo_resolucao', FILTER_SANITIZE_STRING);
    $txt_dataOcorrido = filter_input(INPUT_POST, 'campo_dataOcorrido');
    $txt_dataDevolucao = filter_input(INPUT_POST, 'campo_dataDevolucao', FILTER_SANITIZE_STRING);
    $txt_DataPostagem = filter_input(INPUT_POST, 'campo_DataPostagem', FILTER_SANITIZE_STRING);
    $txt_OsAssistencia = filter_input(INPUT_POST, 'campo_OsAssistencia', FILTER_SANITIZE_STRING);
    $txt_DataDespacho = filter_input(INPUT_POST, 'campo_DataDespacho', FILTER_SANITIZE_STRING);
    $txt_DataServico = filter_input(INPUT_POST, 'campo_DataServico', FILTER_SANITIZE_STRING);
    $txt_DataFechamento = filter_input(INPUT_POST, 'campo_DataFechamento', FILTER_SANITIZE_STRING);
    $txt_DataRetorno = filter_input(INPUT_POST, 'campo_DataRetorno', FILTER_SANITIZE_STRING);
    $txt_tecSut = filter_input(INPUT_POST, 'campo_tecSut', FILTER_SANITIZE_STRING);
    $txt_tipoRegistro = filter_input(INPUT_POST, 'tipoRegistro', FILTER_SANITIZE_STRING);
    $txt_status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    //Session Para trazer dados do usuário//
    $nome = $_SESSION['username'];
    //convert data
    $dataOcorrido = date('Y-m-d H:m:s ', strtotime($txt_dataOcorrido));
    $dataPostagem = date('Y-m-d H:m:s', strtotime($txt_DataPostagem));
    $nOsTec = intval($txt_OsAssistencia);
    $dataDespacho = date('Y-m-d H:m:s ', strtotime($txt_DataDespacho));
    $dataServico = date('Y-m-d H:m:s ', strtotime($txt_DataServico));
    $dataFechamento = date('Y-m-d H:m:s', strtotime($txt_DataFechamento));
    $dataRetorno = date('Y-m-d H:m:s', strtotime($txt_DataRetorno));


    if($txt_descresolucao == ''){
        header('Location: ../Views/detalhes_os.php?id='.$campo_id.'');
        echo '<p>Preenchas os campos</p>';
        die();
    }

    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql();
    if($txt_status == "Fechado"){
        $query = "update CadastroOs set osStatus = 'Fechado' where idOs = $campo_id";
        mysqli_query($link,$query);
    }

    $sql ="insert into HistoricoManutencao ";
    $sql.= "(osId, descResolucao, dataOcorrido, dataPostagem, nOsAssistencia, dataDespacho, dataServico, dataFechamento, dataRetorno, tecnicoSut, tipoReparo, status, tecAtendimento) ";
    $sql.="values ";
    $sql.="('$campo_id','$txt_descresolucao', '$dataOcorrido','$dataPostagem', '$nOsTec', '$dataDespacho', '$dataServico', '$dataFechamento', '$dataRetorno', '$txt_tecSut', '$txt_tipoRegistro', '$txt_status','$iduser') ";

    if(mysqli_query($link,$sql)){
        header('Location: ../Views/detalhes_os.php?status=1?id='.$campo_id.'');
    }else{
        header('Location: ../Views/lista_manutencao.php?status=2'.mysqli_error($link));
    }
?>