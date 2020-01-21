<?
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../Views/login.php?erro=1');
}
require_once('../Cabecalhos/nav-bar.php');
$Valorglobal = $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$msg = null . $nomepeca = null . $idHist = null . $osId = null . $ocorrido = null . $postagem = null . $nOsAssis = null;
$despacho = null . $servico = null . $fechamanento = null . $retorno = null . $tecSut = null . $tipoReparo = null;
$status = null . $tecAtend = null . $dtEdt = null . $dOcorrido = null . $descRes = null . $dpostagem = null . $nOs = null;
$ddespacho = null . $dservico = null . $nomeTec = null;
$vetor = null;
$idT = null;
$nome = null.$nof = null;
$tt = null;
$array = array();
?>
<?
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$sql = "select * from S0005 where osId = $Valorglobal";
$result = mysqli_query($link, $sql);
if (isset($result)) {
    while ($registro = mysqli_fetch_array($result)) {
        $idHist = $registro['idHistorico'];
        $osId = $registro['osId'];
        $descRes = $registro['descResolucao'];
        $ocorrido = $registro['ocorrido'];
        if ($ocorrido == '01/01/1970') {
            $dOcorrido = "";
        } else {
            $dOcorrido = $ocorrido;
        }
        $postagem = $registro['postagem'];
        if ($postagem == '01/01/1970') {
            $dpostagem = "";
        } else {
            $dpostagem = $postagem;
        }
        $nOsAssis = $registro['nOsAssistencia'];
        if ($nOsAssis == 0) {
            $nOs = "";
        } else {
            $nOs = $nOsAssis;
        }
        $despacho = $registro['despacho'];
        if ($despacho == '01/01/1970') {
            $ddespacho = "";
        } else {
            $ddespacho = $despacho;
        }
        $servico = $registro['servico'];
        if ($servico == '01/01/1970') {
            $dservico = "";
        } else {
            $dservico = $servico;
        }
        $fechamanento = $registro['fechamento'];
        if ($fechamanento == '01/01/1970') {
            $dfechamento = "";
        } else {
            $dfechamento = $fechamanento;
        }
        $retorno = $registro['retorno'];
        if ($retorno == '01/01/1970') {
            $dRetorno = "";
        } else {
            $dRetorno = $retorno;
        }
        $tecSut = $registro['tecnicoSut'];
        $tipoReparo = $registro['tipoReparo'];
        $status = $registro['status'];
        $tecAtend = $registro['tecAtendimento'];
        $dtEdt = $registro['edit'];
    }
} else {
    echo '<p>Sem consulta</p>';
}
?>
<?
require_once('../Connections/ConexaoUser.php');
$ObjDB = new DBUser();
$link = $ObjDB->connecta_mysql();
$sql = "select nome from Usuario where idUsuario  = $tecAtend";
$consultauser = mysqli_query($link, $sql);
if ($consultauser) {
    while ($reguser = mysqli_fetch_array($consultauser)) {
        $nomeTec = $reguser['nome'];
    }
} else {
    echo '<div class="container col">
    <h4></H1>Sem registros</h4> 
    </div>';
}
?>
<link rel="stylesheet" href="../PageStyle/styleHome.css">

<body>
    <div class="container class-border col-md-12">
        <div class="form-group">
            <h5>Histórico</h5>
            <hr>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <label for="" value="teste">Cód Hist.: <? echo $idHist ?></label>
            </div>
            <div class="form-group col-md-10">
                <label for="" value="teste">Cód Os: <? echo $osId ?></label>
            </div>
            <div class="form-group col-md-12">
                <label for="" value="teste">Descrição Resolução.: <? echo $descRes ?></label>
            </div>
            <div class="form-group col-md-2">
                <label for="" value="teste">Data Ocorrido.: <? echo $dOcorrido ?></label>
            </div>
            <div class="form-group col-md-3">
                <label for="" value="teste">Data Postagem.: <? echo $dpostagem ?></label>
            </div>
            <div class="form-group col-md-7">
                <label for="" value="teste">N° Assistencia.: <? echo $nOs ?></label>
            </div>
            <div class="form-group col-md-3">
                <label for="" value="teste">Data Despacho.: <? echo $ddespacho ?></label>
            </div>
            <div class="form-group col-md-3">
                <label for="" value="teste">Data Serviço.: <? echo $dservico ?></label>
            </div>
            <div class="form-group col-md-3">
                <label for="" value="teste">Data Fechamento.: <? echo $dservico ?></label>
            </div>
            <div class="form-group col-md-2">
                <label for="" value="teste">Data Retorno.: <? echo $dservico ?></label>
            </div>
            <div class="form-group col-md-3">
                <label for="" value="teste">Téc Sut.: <? echo $tecSut ?></label>
            </div>
            <div class="form-group col-md-3">
                <label for="" value="teste">Tipo Reparo.: <? echo $tipoReparo ?></label>
            </div>
            <div class="form-group col-md-6">
                <label for="" value="teste">Status.: <? echo $status ?></label>
            </div>
            <div class="form-group col-md-10">
                <label for="" value="">Editado por.: <? echo $nomeTec ?> às <? echo $dtEdt ?></label>
            </div>
        </div>
        <hr>
        <div class="container container-config col-md-12">
            <?
            require_once('../Connections/Conexao.php');
            $ObjDB = new DB();
            $links = $ObjDB->connecta_mysql();
            $query = "select idTroca,osId, descricaoPeca, precoUnit from trocaPecas
                     inner join PecasManutencao on idPecas = pecaId where osId = $osId limit 100";
            $query1 = "select sum(precoUnit) from trocaPecas where osId = $osId";
            $totals = mysqli_query($link, $query1);
            if($totals){
            while($total = mysqli_fetch_array($totals)){
                $tt = $total['sum(precoUnit'];
            }
        }
            $consult = mysqli_query($links, $query);
            if (isset($consult)) {
                echo '<table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total</th>

                  </tr>
                </thead>';
                $nof = mysqli_num_fields($consult);
                while ($linha = mysqli_fetch_array($consult)) {
                    for ($i = 0; $i < $nof; $i++) {
                        $nf = mysqli_field_seek($consult, $i);
                        $array[][$nf] = $linha[$i];
                    }
                    $idTroca[] = $linha['idTroca'];
                    $nomes[] = $linha['descricaoPeca'];
                    $preco[] = $linha['precoUnit'];

                    
                }
                ;
            }else{
                echo 'sem registro';
            }
            $idT = implode("<br>",$idTroca);
            $nome = implode("<br>", $nomes);
            $precos = implode("<br>", $preco);
            echo '
            <tbody>
            <tr>
            <th scope="row">'.$idT.'</th>
            <td>'.$nome.'</td>
            <td>'.$precos.'</td>
            <td>'.$totals.'</td>
            </tr>
            </tbody>
            
            </table>
            <tr></tr>';
            ?>

        </div>
    </div>
</body>