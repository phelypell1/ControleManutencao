<?
    require_once('../Connections/Conexao.php');
    $ObjDB = new DB();
    $link = $ObjDB->connecta_mysql();
    $sql = "select * from S0002 where osStatus != 'Fechado' order by dat asc";
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
                <th class="tables" scope="col">Origem</th>
                <th class="tables" scope="col">Departamento</th>
                <th class="tables" scope="col">Status</th>
                <th class="tables" scope="col">Status reparo</th>
                <th class="tables" scope="col"></th>
                <th class="tables" scope="col"></th>
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
            $origem = $registro['origem'];
            $departamento =  $registro['departamento'];
            $status =  $registro['statuOs'];
            $tpReparo = $registro['tipoReparo'];
            $osStatus = $registro['osStatus'];
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
                <td>'.$origem.'</td>
                <td>'.$departamento.'</td>
                <td>'.$status.'</td>
                <td>'.$osStatus.'</td>
                <td><a href="../Views/detalhes_os.php?id='.$os.'"><img src="../imagens/edit-edit.png" width="25"></a></td>
                <td><a href="../Views/listar_detalhes.php?id='.$os.'">detalhes</a></td>
            </tr>
        </tbody>';
        }
    }else{
        echo $sql;
    }

    ?>