<?
session_start();
if(!isset($_SESSION['login'])){
    header('Location: ../Views/login.php?erro=1');
  }
    require_once('../Cabecalhos/nav-bar.php');
    $Valorglobal = $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
?>
<?
require_once('../Connections/Conexao.php');
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$sql = "select * from S0001 where idOs = $Valorglobal";
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
        $origem = $registro['origem'];
        $departamento =  $registro['departamento'];
    }
}

?>
<body>
    <div class="container border">
    <div class="form-row">
    <div class="col-sm-2 painel1">
        <fieldset class="field">
            <legend class="legendPainel1">teste</legend>
        <form action="">
            <div class="form-group col-md-3 separacao">
                <label for="">ID</label>
                <input type="text" class="form-control" value="<?echo$os?>" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="">Equipamento:</label>
                <input type="text" class="form-control" value="<?echo$equipamento?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">SUT:</label>
                <input type="text" class="form-control" value="<?echo$sut?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Patrimônio:</label>
                <input type="text" class="form-control" value="<?echo$patrimonio?>">
            </div>
        </form>
        </fieldset>
    </div>
    <div class="col-md-8 border painel2" >

    </div>
    </div>
    </div>
</body>