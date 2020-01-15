<?  
    session_start();
    require_once('../Cabecalhos/nav-bar.php');
    $status = isset($_GET['status']) ? $_GET['status'] : 0;
    $name = $_SESSION['username'];
?>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../jquery/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script>
$(document).ready(function(){
   $('#money').mask('000.000.000.000.000.00', {reverse: true});
  
  $("#money").change(function(){
    $("#value").html($(this).val().replace(/\D/g,''))
  })
  
});
</script>

<body>
    <div class="container border top">
        <div class="rows">
            <form id="formulario_pecas" action="../Controllers/cadastro_peca.php" method="POST">
            <?php
                if ($status == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>ATENÇÃO!</strong> cadastro realizado com sucesso!
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                }else if($status == 2){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>ERRO 1 <br></strong> Não foi possível proseguir, tente novamente.
           <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
                }
            
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Descrição</label>
                    <input name="campo_descricao" id="campo_descricao" type="text" class="form-control" placeholder="Descrição da peça">
                </div>
                <div class="form-group col-md-3">
                <label for="">Modelo Equipamento.</label>
                        <select name="campo_modelo" id="campo_modelo" class="form-control">
                            <option selected>--Selecione--</option>
                            <option value="SPP-400">SPP-R400</option>
                            <option value="Lumia 640">Lumia 640</option>
                            <option value="Galaxy On7">Galaxy On7</option>
                            <option value="Galaxy J6">Galaxy J6</option>
                            <option value="Galaxy J7">Galaxy J7</option>
                            <option value="Moto G7 play">Moto G7 play</option>
                        </select>
                </div>
                <div class="form-group col-md-3">
                <label for="">Marca Equipamento.</label>
                        <select name="campo_marca" id="campo_marca" class="form-control">
                            <option selected>--Selecione--</option>
                            <option value="Bixolon">Bixolon</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Motorola">Motorola</option>
                            <option value="Microsoft">Microsoft</option>
                        </select>
            </div>
            <div class="form-group col-md-1">
                <label for="">Valor</label>
                <input name="campo_valor" type="decimal" class="form-control" id="money">

            </div>
            <div class="form-group col-md-4">
                <label for="">Responsavel</label>
                <input name="campo_responsavel" id="campo_responsavel" type="text" class="form-control" readonly value="<?echo$name?>">
            </div>

            <div class="form-group col-md-1">
                <button id="btn-salva" type="submit" class="form-control button btn-primary">Salvar</button>
              
            </div>
            <div class="form-group col-md-1">
                <button class="form-control button btn-danger">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</body>