<?
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../Views/login.php?erro=1');
}
require_once('../Cabecalhos/nav-bar.php');
$status = isset($_GET['status']) ? $_GET['status'] : 0;
$Valorglobal = $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
?>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script lang="javascript">
    $(document).ready(function() {
        $('#btn_add').click(function() {
            //alert('Atenção ! Essa parte ainda está em desenvolvimento, em breve estará disponivel');
            $.ajax({
                url: '../Controllers/registro_pecas.php',
                type: 'post',
                data: $('#form').serialize(),
                success: function(data) {
                    alert(data);
                }
            })
        });
    });
</script>
<?
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$sql = "select * from S0003 where idOs = $id";
$result = mysqli_query($link, $sql);

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
        $tipoReparo = $registro['tipoReparo'];
        $status = $registro['osStatus'];
    }
}
?>
<link rel="stylesheet" href="../PageStyle/fieldset.css">
<script src="../jquery/jquery-3.4.1.js"></script>

<body>
    <div class="container">
        <link rel="stylesheet" href="../PageStyle/text-table.css">
        <div class="rows">
            <form action="../Controllers/cadastro_historico.php" method="post">
                <?php
                if ($status == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>ATENÇÃO!</strong> dados cadastrados com sucesso !
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                } else if ($status == 2) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>ERRO  <br></strong> Não foi possível proseguir, tente novamente.
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                } else if ($status == 3) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>ERRO <br></strong>Campos em branco, verifique e tente novamente.
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                }
                ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" hidden="false">ID</label>
                        <input type="text" class="form-control col-md-1" name="campo_idOs" id="campo_imei" maxlength="15" value="<? echo $os ?>" readonly hidden="false">
                    </div>
                    <div class="form-group col-md-2">

                        <label for="">Tipo Eq.</label>
                        <select name="campo_tipo" id="campo_tipo" class="form-control" readonly>
                            <option value="Impressora"><? echo $equipamento ?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">IMEI/Serial</label>
                        <input type="text" class="form-control" name="campo_imei" id="campo_imei" maxlength="15" value="<? echo $imei ?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">SUT</label>
                        <input type="text" class="form-control" name="campo_sut" id="campo_sut" maxlength="6" value="<? echo $sut ?>" readonly>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Patrimônio</label>
                        <input type="text" class="form-control" name="campo_patrimonio" id="campo_patrimonio" maxlength="5" value="<? echo $patrimonio ?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Entrada</label>
                        <input type="text" class="form-control" name="campo_entrada" id="campo_entrada" value="<? echo $dataEntrada ?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Origem</label>
                        <input type="text" class="form-control" name="campo_origem" id="campo_origem" maxlength="25" value="<? echo $origem ?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Departamento</label>
                        <input type="text" class="form-control" name="campo_departamento" id="campo_departamento" maxlength="15" value="<? echo $departamento ?>" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Descrição Defeito</label>
                        <textarea name="campo_descDefeito" id="campo_descDefeito" cols="1" rows="1" class="form-control" readonly><? echo $descDefeito ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Resolução</label>
                        <textarea name="campo_resolucao" id="campo_resolucao" cols="2" rows="2" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="">Data ocorrido</label>
                        <input type="date" name="campo_dataOcorrido" id="campo_dataOcorrido" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Data devolução</label>
                        <input type="date" name="campo_dataDevolucao" id="campo_dataDevolucao" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Data postagem</label>
                        <input type="date" name="campo_DataPostagem" id="campo_campoDataPostagem" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                    </div>
                    <div class="form-group col-md-12">
                        <fieldset class="fieldset3">
                            <legend class="legend3">
                                <h6>Assitência Técnica</h6>
                            </legend>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="">N° da OS</label>
                                    <input name="campo_OsAssistencia" id="campo_OsAssistencia" class="form-control" maxlength="5">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Data Despacho:</label>
                                    <input name="campo_DataDespacho" id="campo_DataDespacho" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Data Serviço:</label>
                                    <input name="campo_DataServico" id="campo_DataServico" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Data Fechamento:</label>
                                    <input name="campo_DataFechamento" id="campo_DataFechamento" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Data Retorno:</label>
                                    <input name="campo_DataRetorno" id="campo_DataRetorno" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Téc. Sut:</label>
                                    <input name="campo_tecSut" id="campo_tecSut" type="text" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <fieldset class="fieldset1">
                        <legend class="legend1">
                            <h6>Tipo Registro</h6>
                        </legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoRegistro" id="Reparo" value="Reparo">
                            <label class="form-check-label" for="Reparo">
                                Reparo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoRegistro" id="Outros" value="Outros">
                            <label class="form-check-label" for="Outros">
                                Outros
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset1 espaco">
                        <legend class="legend1">
                            <h6>Status</h6>
                        </legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="Aberto" value="Aberto">
                            <label class="form-check-label" for="Aberto">
                                Aberto
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="Fechado" value="Fechado">
                            <label class="form-check-label" for="Fechado">
                                Fechado
                            </label>
                        </div>
                    </fieldset>
                    <div class="col">
                        <button type="submit" class="btn btn-success" id="btn_finalizar">Finalizar</button>
                        <a href="../Views/home.php" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
        </div>
        </form>
        <div class="form-group col-md-8">
            <form id="form">
                <fieldset class="fieldset2 espaco1">
                    <legend class="legend2">
                        <h6>Adicione peças trocadas</h6>
                    </legend>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <select name="campo" id="campo" class="form-control">
                                <option selected>--Selecione--</option>
                                <?
                                require_once('../Connections/Conexao.php');
                                $ObjDB = new DB();
                                $link = $ObjDB->connecta_mysql();
                                if($equipamento == "Impressora"){
                                    $sql = "select * from PecasManutencao where marcaEquipamento = 'Bixolon'";
                                }else{
                                    $sql = "select * from PecasManutencao where marcaEquipamento = 'Motorola'";
                                }
                                
                                $result = mysqli_query($link, $sql);
                                if ($result) {
                                    while ($registro = mysqli_fetch_array($result)) {

                                        $idPecas = $registro['idPecas'];
                                        $descricaoPeca = $registro['descricaoPeca'];
                                        $valor =  $registro["valorPeca"];

                                        echo '<option value="' . $idPecas . '">' . $descricaoPeca . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input name="campo_valor" id="campo_valor" class="form-control" type="decimal" value="<? echo $valor ?>" hidden>
                            <input name="campo_os" id="campo_osId" class="form-control" type="text" value="<? echo $os ?>" hidden>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="button" id="btn_add" class="btn btn-alert-success"><img src="../imagens/mais.png" width="25" disable="true"></button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </div>
</body>