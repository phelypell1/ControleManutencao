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
    $sql = "select idPecas, descricaoPeca, ModeloEquipamento, MarcaEquipamento, valorPeca, DATE_FORMAT(dataEntrada, '%d-%m-%Y')as dat, responsavelCadastro from PecasManutencao";
    $result = mysqli_query($link, $sql);

    echo '<table class="table table-bordered table-hover table-sm">
            <thead>
              <tr>
                <th class="tables" scope="col">#</th>
                <th  class="tables"class="tables" scope="col">Item</th>
                <th class="tables" class="tables" scope="col">Modelo</th>
                <th class="tables" scope="col">Marca</th>
                <th class="tables" scope="col">Valor</th>
                <th class="tables" scope="col">Data Cadastro</th>
                <th class="tables" scope="col">Cadastrado por</th>
              </tr>
            </thead>';
              

    if ($result) {
        while ($registro = mysqli_fetch_array($result)) {
            $id = $registro['idPecas'];
            $desc = $registro['descricaoPeca'];
            $modelo = $registro['ModeloEquipamento'];
            $marca = $registro['MarcaEquipamento'];
            $valor = $registro['valorPeca'];
            $data = $registro['dat'];
            $responsavel = $registro['responsavelCadastro'];

            /////////////////////////////////////////
            echo '
        <tbody class="table-borderless">    
            <tr>
                <th scope="row" class="td">'.$id.'</th>
                <td>'.$desc.'</td>
                <td>'.$modelo.'</td>
                <td>'.$marca.'</td>
                <td>'.$valor.'</td>
                <td>'.$data.'</td>';
                if($responsavel == 1){
                    $nome1 = 'Phelype Rodrigo dos Santos';
                    echo'<td>'.$nome1.'</td>';
                }else{
                    $nome2 = 'Claiton Alves da Silva';
                    echo'<td>'.$nome2.'</td>';
                }
            '</tr>
        </tbody>';
        }
    }
    ?>
</body>