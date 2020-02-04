<?php
/*Variaveis*/
$htId = null;
$osId = null;
$desc = null;
$datOc = null;
$datPost = null;
$ordAssit = null;
$datDesp = null;
$datServ = null;
$datFech = null;
$datRet = null;
$tecSut = null;
$tpReparo = null;
$tpStatus = null;
$tecAssitencia = null;
$nomeTec = null;
$id = $_POST['id'];
/*------------------------------------------------------------------- */

require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$id = $_POST['id'];

$query = "SELECT * FROM ControleManutencao.S0003 where idOs = $id";
if ($consulta = mysqli_query($link, $query)) {
    while ($registros = mysqli_fetch_array($consulta)) {
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

/*------------------------------------------------------------------- */
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();

$query = "SELECT * FROM S0004 where osId = $id";
$consulta = mysqli_query($link, $query);
if (mysqli_num_rows($consulta) > 0) {
    while ($registros = mysqli_fetch_array($consulta)) {
        $htId = $registros['idHistorico'];
        $osId = $registros['osId'];
        $desc = $registros['descResolucao'];
        $datOc = $registros['ocorrido'];
        $datPost = $registros['postagem'];
        $ordAssit = $registros['nOsAssistencia'];
        $datDesp = $registros['despacho'];
        $datServ = $registros['servico'];
        $datFech = $registros['fechamento'];
        $datRet = $registros['retorno'];
        $tecSut = $registros['tecnicoSut'];
        $tpReparo = $registros['tipoReparo'];
        $tpStatus = $registros['status'];
        $tecAssitencia = $registros['tecAtendimento'];
    }

    require_once('../Connections/ConexaoUser.php');
    $ObjDB = new DBUser();
    $link = $ObjDB->connecta_mysql();
    $sql = "select nome from Usuario where idUsuario  = $tecAssitencia";
    $consultauser = mysqli_query($link, $sql);
    if ($consultauser) {
        while ($reguser = mysqli_fetch_array($consultauser)) {
            $nomeTec = $reguser['nome'];
        }
    } else {
    }
    
    echo '<link rel="stylesheet" href="../PageStyle/lista.css">
    <form>
        <div class="form-row">
            <div class="col-1">
                <label for="">Cód Hts</label>
                <input type="text" class="form-control form-control-sm col-md-8" value="' . $htId . '" readonly>
            </div>
            <div class="col-1">
                <label for="">Cód Os</label>
                <input type="text" class="form-control form-control-sm col-md-8" value="' . $osId . '" readonly>
            </div>
            <div class="col-3">
            </div>
            <div class="col">
                <div class="border">
                    <table class="table table-est ">
                        <thead>
                            <tr>
                                <th scope="col">descricao</th>
                                <th scope="col">Data</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">-</th>
                                    <td>- </td>
                                    <td>- </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-row ">
            <div class="col-7 margin-t">
                <label for="">Resolução</label>
                <textarea type="text" rows="2" class="form-control form-control-sm col-md-8" readonly>'.$desc.'</textarea>
            </div>
            <div class="col-7">
                <label for="">Editado por</label>
                <input type="text" class="form-control form-control-sm col-md-4" value="' . $nomeTec . '"readonly>
            </div>
            <div class="col-5">
            </div>
            <hr>
            <hr>
            <div class="col-2">
                <label for="">Data Ocorrido</label>
                <input type="text" class="form-control form-control-sm col-md-8" value="'.$datOc.'"readonly>
            </div>
            <div class="col-10">
            </div>
            <div class="col-2">
                <label for="">Data Devolução</label>
                <input type="text" class="form-control form-control-sm col-md-8" value="'.$datPost.'"readonly>
            </div>
            <div class="col-10">
            </div>
            <div class="col-2">
                <label for="">Data Postagem</label>
                <input type="text" class="form-control form-control-sm col-md-8" value="'.$dataEntrada.'"readonly>
            </div>
        </div>

        <div class="col-7 border assist">
            <fieldset class="fielsetAssist">
                <legend><h6>Assistência Técnica</h6></legend>
                <div class="row col">
                <div class="col">
                <label for="">Dt despacho</label>
                <input type="text" class="form-control form-control-sm col-md-10" value="'.$datDesp.'"readonly>
            </div>
            <div class="col">
                <label for="">Dt Serviço</label>
                <input type="text" class="form-control form-control-sm col-md-10" value="'.$datServ.'"readonly>
            </div>
            <div class="col">
                <label for="">Dt Fechamento</label>
                <input type="text" class="form-control form-control-sm col-md-10" value="'.$datFech.'"readonly>
            </div>
            <div class="col">
                <label for="">Dt Retorno</label>
                <input type="text" class="form-control form-control-sm col-md-10" value="'.$datRet.'"readonly>
            </div>
            </div>
            <div class="col">
                <label for="">Técnico SUT</label>
                <input type="text" class="form-control form-control-sm col-md-4" value="'.$tecSut.'"readonly>
            </div>
            <div class="col">
                <label for="">N° da OS</label>
                <input type="text" class="form-control form-control-sm col-md-2" value="'.$ordAssit.'"readonly>
            </div>
            </fieldset>
        </div>
    </form>
    ';
} else {
    echo '<div class="container border" style="margin-top: 20px; color:red;">
        <div class="col-md-12" style="margin-top:10px">
            <h6>Atenção ! consulta não retornou registros.</h6>
        </div>
    </div>';
}

