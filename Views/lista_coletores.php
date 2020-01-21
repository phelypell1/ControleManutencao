<?php
session_start();
if(!isset($_SESSION['login'])){
    header('Location: ../Views/login.php?erro=1');
  }
require_once('../Cabecalhos/nav-bar.php');
?>
<link rel="stylesheet" href="../PageStyle/text-table.css">
<body>
    <?
    require_once('../Connections/Conexao.php');
    $ObjDB = new DB();
    $link = $ObjDB->connecta_mysql();
    $sql = "select idOs,tipoEquipamento, IMEI, Patrimonio, descricaoDefeito, date_format(dataEntrada, '%d-%m-%Y')as dat,
    osStatus from CadastroOs where tipoEquipamento = 'Smartphone'";
    $result = mysqli_query($link, $sql);
    echo '
    <div class="container tbl-tbl">
    <table class="table table-bordered table-hover table-sm tbl-tbl">
            <thead>
              <tr>
                <th class="tables" scope="col">#</th>
                <th  class="tables"class="tables" scope="col">Equipamento</th>
                <th class="tables" class="tables" scope="col">IMEI</th>
                <th class="tables" scope="col">Patrimônio</th>
                <th class="tables" scope="col">Defeito</th>
                <th class="tables" scope="col">Entrada</th>
                <th class="tables" scope="col">Status</th>
                <th class="tables" scope="col">Nova OS</th> 
                <th class="tables" scope="col">Histórico</th>
                <th class="tables" scope="col">Impressão</th>
              </tr>
            </thead>
            </div>';
              

    if ($result) {
        while ($registro = mysqli_fetch_array($result)) {
            $os = $registro['idOs'];
            $equipamento = $registro['tipoEquipamento'];
            $imei = $registro['IMEI'];
            $patrimonio = $registro['Patrimonio'];
            $descDefeito = $registro['descricaoDefeito'];
            $dataEntrada = $registro['dat'];
            $status =  $registro['osStatus'];
            /////////////////////////////////////////
            echo '
        <tbody class="table-borderless">    
            <tr>
                <th scope="row" class="td">'.$os.'</th>
                <td>'.$equipamento.'</td>
                <td>'.$imei.'</td>
                <td>'.$patrimonio.'</td>
                <td>'.$descDefeito.'</td>
                <td>'.$dataEntrada.'</td>
                <td>'.$status.'</td>
                <td><a href="../Views/detalhes_os.php?id='.$os.'"><img src="../imagens/alert.png" width="30"></a></td>
                <td><a href="../Views/listar_detalhes.php?id='.$os.'"><img src="../imagens/list.png" width="25"></a></td>
                <td><a href="../Relatorio/relatorio_garantia.php?id='.$os.'"><img src="../imagens/imprimir.png" width="25"></a></td>
            </tr>
        </tbody>';
        }
    }
    ?>
</body>