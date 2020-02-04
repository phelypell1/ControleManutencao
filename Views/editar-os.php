<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../Views/login.php?erro=1');
}
require_once('../Cabecalhos/nav-bar.php');
$dats = date('d/m/Y');
$status = isset($_GET['status']) ? $_GET['status'] : 0;
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$nomesCid = null;
?>
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function() {
        $('#campo_tipo').change(function() {
            var valor = $('#campo_tipo option:selected').text();
            if (valor == 'Smartphone') {
                $('#campo_sut').attr('disabled', true);
                $('#campo_imei').attr('disabled', false);
            } else if (valor == 'Impressora') {
                $('#campo_imei').attr('disabled', false);
                $('#campo_sut').attr('disabled', false);
            }
        });
    });
</script>
<!--<script lang="javascript">
    $(document).ready(function() {
        $('#btn-add').click(function() {
            $.ajax({
                    url: '../Controllers/add-img.php',
                    method: 'post',
                    data: $('#add-img').serialize(),
                    success: function(data) {
                        alert(data);
                    }
                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);
                });
        });
    });
</script>-->
<script lang="javascript">
    $(document).ready(function() {
        $('#btn-novaos').click(function() {

            $.ajax({
                url: '../Controllers/atualiza-os.php',
                method: 'post',
                data: $('#formulario_os').serialize(),
                success: function(data) {
                    /*$('#campo_tipo').val('--Selecione--');
                    $('#campo_imei').val('');
                    $('#campo_sut').val('');
                    $('#campo_patrimonio').val('');
                    $('#campo_entrada').val('<? print_r($dats) ?>');
                    $('#campo_origem').val('');
                    $('#campo_departamento').val('');
                    $('#campo_descDefeito').val('');
                    $('#campo_Status').val('--Selecione--');
                    $('#tipoRegistro').val('');
                    $('#status').val('');*/
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
$sql = "select * from S0009 where idOs = $id";
$result = mysqli_query($link, $sql);

if ($result) {
    while ($registro = mysqli_fetch_array($result)) {
        $os = $registro['idOs'];
        $equipamento = $registro['tipoEquipamento'];
        $imei = $registro['IMEI'];
        $sut = $registro['SUT'];
        $patrimonio = $registro['patrimonio'];
        $descDefeito = $registro['descricaoDefeito'];
        $dataEntrada = $registro['datEntrada'];
        $tecnicoRecebimento = $registro['tecnicoRecebimento'];
        $origem = $registro['nomeCidade'];
        $departamento =  $registro['nomeDep'];
        $statuOs = $registro['statuOs'];
        $tipoReparo = $registro["tipoReparo"];
        $status = $registro['osStatus'];
    }
}
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$sql1 = "select * from Cidades where nomeCidade = '$origem'";
$result1 = mysqli_query($link, $sql1);
if ($result1) {
    while ($registro1 = mysqli_fetch_array($result1)) {
        $codCid = $registro1['codCidade'];
        $nomesCid = $registro1['nomeCidade'];
    }
}

require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$sql = "select * from Departamento where nomeDep = '$departamento'";
$result = mysqli_query($link, $sql);
if ($result) {
    while ($registro = mysqli_fetch_array($result)) {
        $codDep = $registro['codDep'];
        $nomeDep = $registro['nomeDep'];
    }
}

?>

<body>
    <div class="container border top">
        <div class="rows">
            <form id="formulario_os">
                <?php
                if ($status == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>ATENÇÃO!</strong> seu chamado foi aberto!
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                } else if ($status == 2) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>ERROR 2 <br></strong> Não foi possível proseguir, tente novamente.
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                } else if ($status == 3) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>ERROR 3 <br></strong> Atenção os campo com (*) são obrigatórios.
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                } else if ($status == 4) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>ERROR 3 <br></strong> Atenção.
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                }

                ?>
                <div class="form-row">
                <div class="form-group col-md-1" >
                        <label for="">Código *</label>
                        <input type="text" class="form-control form-control-sm" name="campo_cod" id="campo_cod" maxlength="15" value="<? echo $os ?>" readonly>
                    </div>
                    <div class="col-md-11">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Tipo Eq. *</label>
                        <select name="campo_tipo" id="campo_tipo" class="form-control form-control-sm">
                            <option selected><? echo $equipamento ?></option>
                            <option disabled></option>
                            <option value="Impressora">Impressora</option>
                            <option value="Smartphone">Smartphone</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">IMEI/Serial *</label>
                        <input type="text" class="form-control form-control-sm" name="campo_imei" id="campo_imei" maxlength="15" value="<? echo $imei ?>">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">SUT *</label>
                        <input type="text" class="form-control form-control-sm" name="campo_sut" id="campo_sut" maxlength="6" value="<? echo $sut ?>">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="">Patrimônio *</label>
                        <input type="text" class="form-control form-control-sm" name="campo_patrimonio" id="campo_patrimonio" maxlength="5" value="<? echo $patrimonio ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Entrada</label>
                        <input type="text" class="form-control form-control-sm" name="campo_entrada" id="campo_entrada" value="<? echo $dats ?>" value="<? echo $dataEntrada ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Cidade Origem *</label>
                        <select name="campo_origem" id="campo_origem" class="form-control form-control-sm">
                            <option selected value="<? echo $codCid ?>"><? echo $origem ?></option>
                            <option disabled> </option>
                            <?
                            require_once('../Connections/Conexao.php');
                            $ObjDB = new DB();
                            $link = $ObjDB->connecta_mysql();
                            $sql = "select * from Cidades order by nomeCidade limit 200";
                            $result = mysqli_query($link, $sql);
                            if ($result) {
                                while ($registro = mysqli_fetch_array($result)) {
                                    $codCidade = $registro['codCidade'];
                                    $nomeCid = $registro['nomeCidade'];
                                    echo '<option value="' . $codCidade . '">' . $nomeCid . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Departamento *</label>
                        <select name="campo_departamento" id="campo_departamento" class="form-control form-control-sm">
                            <option selected value="<?echo$codDep?>"><? echo $departamento ?></option>
                            <option disabled> </option>
                            <?
                            require_once('../Connections/Conexao.php');
                            $ObjDB = new DB();
                            $link = $ObjDB->connecta_mysql();
                            $sql = "select * from Departamento order by nomeDep limit 200";
                            $result = mysqli_query($link, $sql);
                            if ($result) {
                                while ($registro = mysqli_fetch_array($result)) {
                                    $codCidade = $registro['codDep'];
                                    $nomeCid = $registro['nomeDep'];
                                    echo '<option value="' . $codCidade . '">' . $nomeCid . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Descrição Defeito *</label>
                        <textarea name="campo_descDefeito" id="campo_descDefeito" cols="4" rows="2" class="form-control form-control-sm"><?echo$descDefeito?></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Status Equipamento. *</label>
                        <select name="campo_Status" id="campo_Status" class="form-control form-control-sm">
                            <option value="<?echo$statuOs?>"><?echo$statuOs?></option>
                            <option disabled> </option>
                            <option value="Manutenção">Ativo</option>
                            <option value="Outros">Inativo</option>
                            <option value="Outros">Manutenção</option>
                            <option value="Outros">Devolvido</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <fieldset class="fieldsetCad">
                            <legend class="legendCad">
                                <h6>Tipo Registro *</h6>
                            </legend>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoRegistro" id="Reparo" value="Reparo" <?php echo($tipoReparo == "Reparo") ? "checked" : null ?>>
                                <label class="form-check-label" for="Reparo" che>
                                    Reparo
                                </label>
                           </div>
                           <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoRegistro" id="Outros" value="Outros" <?php echo($tipoReparo == "Outros") ? "checked" : null ?>>
                                <label class="form-check-label" for="Outros">
                                    Outros
                                </label>
                                
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <fieldset class="fieldsetCad1">
                            <legend class="legendCad1">
                                <h6>Status *</h6>
                            </legend>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="Aberto" value="Aberto" <?php echo($status == "Aberto") ? "checked" : null ?>>
                                <label class="form-check-label" for="Aberto">
                                    Aberto
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="Fechado" value="Fechado" <?php echo($status == "Fechado") ? "checked" : null ?>>
                                <label class="form-check-label" for="Fechado">
                                    Fechado
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-7 col">
                        <fieldset class="fieldsetCad5">
                            <legend class="legendCad5">Adicionar Imagem</legend>
                            <div class="form-group">
                                <a href="../Cadastros/add-pecas.php?id=''" class="">Clique aqui para adicionar imagens<img src="../imagens/cadastrar.png" width="35"></a>
                            </div>

                        </fieldset>
                    </div>
                    <div class="form-group col-2">
                        <input id="btn-novaos" type="button" class=" form-control btn btn-success btn-border" value="Atualizar">
                    </div>
                    <div class="form-group col-2">
                        <a href="../Views/home.php" class="btn btn-danger btn-border">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>