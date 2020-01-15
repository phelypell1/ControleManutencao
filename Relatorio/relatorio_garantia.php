<?
session_start();
if(!isset($_SESSION['login'])){
    header('Location: ../Views/login.php?erro=1');
  }
require_once('../Connections/Conexao.php');
$dataCompra = '02/05/2018';



//$date = date_create();
setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d h:m:s');
$txt_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$ObjDB = new DB();
$link = $ObjDB->connecta_mysql();
$sql = "select * from CadastroOs where idOs = '$txt_id'";
$result = mysqli_query($link, $sql);
if ($result) {
    while ($registro = mysqli_fetch_array($result)) {
        $os = $registro['idOs'];
        $equipamento = $registro['tipoEquipamento'];
        $imei = $registro['IMEI'];
        $sut = $registro['SUT'];
        $patrimonio = $registro['patrimonio'];
        $descDefeito = $registro['descricaoDefeito'];
        $dataEntrada = $registro['dataEntrada'];
        $tecnicoRecebimento = $registro['tecnicoRecebimento'];
        $origem = $registro['origem'];
        $departamento =  $registro['departamento'];
        $dataNova = date('d/m/Y', strtotime($dataEntrada));
    }
}

?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../PageStyle/relatorio-garantia.css">
<script>
	window.onload = function() {
		var imprimir = document.querySelector("#imprimir");
		    imprimir.onclick = function() {
		    	imprimir.style.display = 'none';
                window.print();
		    	var time = window.setTimeout(function() {
		    		imprimir.style.display = 'block';
		    	}, 1000);
		    }
	}
</script>
<body>
    <div class="col-md-12">
    <a class="btn btn-primary col-md-12" id="imprimir">imprimir</a>
    </div>
    
    <div class="container">
        <img class="img-top" src="../imagens/fr.png" width="180">
        <h1>Solicitação de reparo equipamento na garantia</h1>
        <h4><? echo 'Goiânia: ' . strftime("%A-feira, %d de %B de %Y %H:%M:%S  ", strtotime($date)) ?></h4>
    </div>
    <div class="container top ">
        <div class="form-row">
            <?
                if($equipamento == "Smartphone"){
                    $complemento = "IMEI: ";
                }else{
                    $complemento = "S/N BRAANKA";
                }           
            ?>
            <p class="col-md-3"><? echo $complemento.$imei ?></p>
            <p class="col-md-2">N° patrimônio: <? echo $patrimonio ?></p>
            <?
                 if($equipamento == "Smartphone"){
                     $lacre = "";
                 }else{
                     $lacre = "N° lacre: ";
                 }
            ?>
            <p class="col-md-2"><?$lacre?><? echo $sut ?></p>
        </div>
        <div class="form-row">
                <?
                    if($equipamento == "Smartphone"){
                        $marca = "Marca: Samsung";
                        $modelo = "Modelo: Galaxy J7";
                    }else{
                        $marca = "Marca: Bixolon";
                        $modelo = "Modelo: SPP-R400";
                    }
                ?>
            <p class="col-md-3"><?echo$marca?></p>
            <p class="col-md-4"><?echo$modelo?></p>
        </div>
        <div class="form-row">
            <p class="col-md-3">Data Compra: <?echo$dataCompra?></p>
        </div>
        <div class="form-row">
            <p class="col-md-3">Data Ocorrido: <? echo $dataNova ?></p>
        </div>
        <div class="form-row">
            <p class="col-md-12"><b>Descrição defeito:</b></p>
            <p class="col-md-12"><? echo $descDefeito ?></p>
        </div>
        <div class="form-group espacamento">
            <div class="col-md-4 form-row">
            </div>
            <hr class="pp1">
            <div class="col-md-4">
                <p class="col-md-12 pp"><?echo$tecnicoRecebimento?></p>
                <p class="col-md-12 pp">Téc. em Informática</p>
                <p class="col-md-12 pp">webmaster@freng.com.br</p>
            </div>
            <div class="col-md-4 form-row">
            </div>
        </div>
    </div>
<p class="rodape">Rua T-53, N° 262 Setor Marista, Goiânia, CEP 74-150.310. Telefone (62) 3242-1718</p>
</body>