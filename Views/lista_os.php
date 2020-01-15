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
    $sql = "select * from S0003 order by idOs";
    $result = mysqli_query($link, $sql);
    echo '<table class="table table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th class="tables" scope="col">#</th>
                <th  class="tables"class="tables" scope="col">Equipamento</th>
                <th class="tables" class="tables" scope="col">IMEI</th>
                <th class="tables" scope="col">SUT</th>
                <th class="tables" scope="col">Patrimônio</th>
                <th class="tables" scope="col">Defeito</th>
                <th class="tables" scope="col">Entrada</th>
                <th class="tables" scope="col">Técnico</th>
                <th class="tables" scope="col">Origem</th>
                <th class="tables" scope="col">Departamento</th>
                <th class="tables" scope="col">Impressão</th>
              </tr>
            </thead>';
              

    if ($result) {
        while ($registro = mysqli_fetch_array($result)) {
            $os = $registro['idOs'];
            $equipamento = $registro['tipoEquipamento'];
            $imei = $registro['IMEI'];
            $sut = $registro['SUT'];
            $patrimonio = $registro['patrimonio'];
            $descDefeito = $registro['descricaoDefeito'];
            $dataEntrada = $registro['dat'];
            $tecnicoRecebimento = $registro['tecnicoRecebimento'];
            $origem = $registro['nomeCidade'];
            $departamento =  $registro['nomeDep'];
            /////////////////////////////////////////
            echo '
        <tbody class="table-borderless">    
            <tr>
                <th scope="row" class="td">'.$os.'</th>
                <td>'.$equipamento.'</td>
                <td>'.$imei.'</td>
                <td>'.$sut.'</td>
                <td>'.$patrimonio.'</td>
                <td>'.$descDefeito.'</td>
                <td>'.$dataEntrada.'</td>
                <td>'.$tecnicoRecebimento.'</td>
                <td>'.$origem.'</td>
                <td>'.$departamento.'</td>
                <td><a href="../Relatorio/relatorio_garantia.php?id='.$os.'"><img src="../imagens/imprimir.png" width="25"></a></td>
            </tr>
        </tbody>';
        }
    }
    ?>
</body>