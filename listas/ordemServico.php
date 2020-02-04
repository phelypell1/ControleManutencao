<?php
   require_once('../Connections/Conexao.php');
   $ObjDB = new DB();
   $link = $ObjDB->connecta_mysql();
   $id = $_POST['id'];
   
   $query = "SELECT * FROM ControleManutencao.S0003 where idOs = $id";
    if($consulta = mysqli_query($link, $query)){
        while($registros = mysqli_fetch_array($consulta)){
            $idOs = $registros["idOs"];
            $tp_eq = $registros['tipoEquipamento'];
            $imei = $registros['IMEI'];
            $sut = $registros['SUT'];
            $patrimonio = $registros['patrimonio'];
            $descDefeito = $registros['descricaoDefeito'];
            $dataEntrada = $registros['dat'];
            $tecReceb = $registros['tecnicoRecebimento'];
            $origem = $registros['nomeCidade'];
            $departamento = $registros['nomeDep'];
            $statuOs = $registros['statuOs'];
            $tipoReparo = $registros['tipoReparo'];
            $osStatus = $registros['osStatus'];
        }
    }
     echo'<div class="container border cont-border">
        
        <div class="row">
            <div class="form-group col-md-1">
                <label for="">ID:</label>
                <input type="text" class="form-control input" value="'.$idOs.'" readonly>
            </div>
            <div class="form-group">
                <label for="">Equipamento:</label>
                <input type="text" class="form-control input tp-eq" value="'.$tp_eq.'" readonly>
            </div>
            <div class="form-group col-2">
                <label for="">Imei:</label>
                <input type="text" class="form-control input imei" value="'.$imei.'" readonly>
            </div>
            <div class="form-group col-1">
                <label for="">Sut:</label>
                <input type="text" class="form-control input sut" value="'.$sut.'" readonly>
            </div>
            <div class="form-group col-2">
                <label class="label" for="">Patr.:</label>
                <input type="text" class="form-control input patrimonio" value="'.$patrimonio.'" readonly>
            </div>
            <div class="form-group col-2 cidade">
                <label  for="">Cidade.:</label>
                <input type="text" class="form-control input" value="'.$origem.'" readonly>
            </div>
            <div class="form-group col-2">
                <label class="label" for="">Departamento.:</label>
                <input type="text" class="form-control dep input" value="'.$departamento.'" readonly>
            </div>
            <div class="form-group col-12">
                <label for="">Descricao Defeito:</label>
                <textarea rows="3" cols="10" type="text" class="form-control input" readonly>'.$descDefeito.'</textarea>
            </div>
            <div class="form-group col-2">
                <label for="">Entrada: <b>'.$dataEntrada.'</b></label>
            </div>
            <div class="form-group col-4">
                <label for="">Responsável: <b>'.$tecReceb.'</b></label>
            </div>
            <div class="form-group col-2">
                <label for="">Status: <b>'.$statuOs.'</b></label>
            </div>
            <div class="form-group col-2">
                <label for="">Tipo Os: <b>'.$tipoReparo.'</b></label>
            </div>
            <div class="form-group col-2">
                <label for="">STS OS: <b>'.$osStatus.'</b></label>
            </div>
        </div>
     </div>';
