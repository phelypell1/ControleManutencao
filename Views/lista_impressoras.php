<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('Location: ../Views/login.php?erro=1');
}
require_once('../Cabecalhos/nav-bar.php');
?>
<link rel="stylesheet" href="../PageStyle/text-table.css">
<script src="../jquery/jquery-3.4.1.js"></script>
<body>

  <div id="lista_imp" class="table-responsive">
  <?
    require_once('../Connections/Conexao.php');
    $ObjDB = new DB();
    $link = $ObjDB->connecta_mysql();
    $maxlink = 50;
    $pagina = (isset($_GET['pagina'])) ? (int) $_GET['pagina'] : 1;
    $maximo = 8;
    $inicio = (($maximo * $pagina) - $maximo);

    $sql = "select idOs,tipoEquipamento, IMEI, Patrimonio, descricaoDefeito, date_format(dataEntrada, '%d-%m-%Y')as dat,
    osStatus from CadastroOs where tipoEquipamento = 'impressora' order by idOs asc limit $inicio, $maximo";
    $result = mysqli_query($link, $sql);
    echo ' 
    <div class="container tbl-tbl ">
    <table class="table table-borderless table-sm tbl-tbl">
            <thead>
              <tr>
                <th class="tables" scope="col" width="40">#</th>
                <th  class="tables"class="tables" scope="col" width="110">Equipamento</th>
                <th class="tables" class="tables" scope="col" width="110">IMEI</th>
                <th class="tables" scope="col" width="110">Patrimônio</th>
                <th class="tables" scope="col" width="500">Defeito</th>
                <th class="tables" scope="col">Entrada</th>
                <th class="tables" scope="col">Status</th>
                <th class="tables" scope="col" width="55">Editar</th>
                <th class="tables" scope="col" width="80">Nova OS</th> 
                <th class="tables" scope="col" width="80">Histórico</th>
                <th class="tables" scope="col" width="90">Impressão</th>
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
        <tbody class="table">    
            <tr>
                <th scope="row" class="td">' . $os . '</th>
                <td >' . $equipamento . '</td>
                <td>' . $imei . '</td>
                <td>' . $patrimonio . '</td>
                <td>' . $descDefeito . '</td>
                <td>' . $dataEntrada . '</td>
                <td>' . $status . '</td>
                <td><a href="../Views/editar-os.php?id=' . $os . '"><img src="../imagens/edit-edit.png" width="25"></a></td>
                <td><a href="../Views/detalhes_os.php?id=' . $os . '"><img src="../imagens/alert.png" width="30"></a></td>
                <td><a href="../Views/new_detalhes.php?id=' . $os . '"><img src="../imagens/list.png" width="25"></a></td>
                <td><a href="../Relatorio/relatorio_garantia.php?id=' . $os . '"><img src="../imagens/imprimir.png" width="25"></a></td>
            </tr>
        </tbody>';
      }
    }
    ?></div>
  <div>
    <?
    require_once('../Connections/Conexao.php');
    $ObjDB = new DB();
    $link = $ObjDB->connecta_mysql();
    $query = "select idOs,tipoEquipamento, IMEI, Patrimonio, descricaoDefeito, date_format(dataEntrada, '%d-%m-%Y')as dat,
    osStatus from CadastroOs where tipoEquipamento = 'impressora'";
    $result_query = mysqli_query($link, $query);
    $total =  $result_query->num_rows;
    $total_pg = ceil($total/$maximo);
    if($total > $maximo){
    echo' <nav aria-label="Navegação de página exemplo" clas="col-md-10">';
    echo'<ul class="pagination justify-content-center">';
    echo'<li class="page-item">';
      echo' <a class="page-link" href="?pagina=1" tabindex="-1">Primeiro</a>';
      for($i = $pagina - $maxlink; $i <= $pagina -1; $i++){
        if($i >= 1){
          echo '<li>';
        echo' <a class="page-link" href="?pagina='.$i.'" tabindex="-1">'.$i.'</a>';
        echo'</li>';
        }
    }
    echo '<li>';
        echo' <a class="page-link" href="?pagina='.$pagina.'">'.$pagina.'</a>';
        echo'</li>';
    for($i = $pagina +1; $i <= $pagina + $maxlink; $i++){
      if($i <= $total_pg){
        echo '<li>';
        echo' <a class="page-link" href="?pagina='.$i.'" tabindex="-1">'.$i.'</a>';
        echo'</li>';
      }
    }
    echo '<li>';
    echo' <a class="page-link" href="?pagina='.$total_pg.'">Ultima</a>';
    echo'</li>';
    }
    echo'<ul>';
    echo'</ul>';
    echo'<nav>';
    echo'</nav>';
    
    

    /*if($total > $maximo){
      echo'<a class="page-item" href="?pagina=1">Primeira</a>';
      for($i = $pagina - $maxlink; $i <= $pagina -1; $i++){
          if($i >= 1){
            echo'<a href="?pagina='.$i.'">'.$i.'</a>';
          }
      }
      echo '<span>'.$pagina.'</span>';

      for($i = $pagina +1; $i <= $pagina + $maxlink; $i++){
        if($i <= $total_pg){
          echo'<a href="?pagina='.$i.'">'.$i.'</a>';
        }
    }
      echo'<a href="?pagina='.$total_pg.'">Ultima</a>';
    }*/

    ?>
  </div>
</body>