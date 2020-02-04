<?php
    session_start();
    require_once('../Cabecalhos/nav-bar.php');
    $id = $_SESSION['id'];
    $msg;
?>
<?
    require_once('../Connections/ConexaoUser.php');
    $ObjDB = new DBUser();
    $link = $ObjDB->connecta_mysql();

    $query ="select * from Login where idLogin = '$id'";
    $result_query = mysqli_query($link, $query);
    
    if($result_query){
        while($result_valor = mysqli_fetch_array($result_query)){

            $idUsuario = $result_valor['idLogin'];
            $login = $result_valor['Login'];
            $senha = $result_valor['senha'];
            $data_cad = $result_valor['DataCadastro'];
            $data_alt = $result_valor['DataUIAlteracao'];
        }
    }
    $data_convert = date('d/m/Y H:m', strtotime($data_alt));
?>
<script src="../jquery/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function(){
        $('#btnEnvia').click(function(){
            if($('#campo_senha').val() =='' || $('#campo_confirma_senha').val() ==''){
                alert('Atenção ! campos em branco');
            }else{
                $.ajax({
                url: '../Controllers/alteraSenha.php',
                method: 'post',
                data: $('#form-senha').serialize(),
                success: function(data) {
                    alert(data);
                }
            })
            }
        })
    })
</script>
<body>
<div class="container">
        <div class="row">
        <div class="col-md-4 "></div>
            <div class="col-md-4 ">
                <h4 class="">Altera senha</h4>
                <hr>
                <form id="form-senha">
                    <fieldset class="borderchamado">
                        <div class="form-group col-md-12">
                            <br>
                            <div class="form-group col-md-12">
                            <label for="">Nome:</label>
                            <input type="text" value="<?echo$login?>" class="form-control form-control-sm" id="campo_login" name="campo_login" readonly>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="">Nova senha:</label>
                            <input type="password"  class="form-control form-control-sm" id="campo_senha" name="campo_senha">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="">Confirme senha:</label>
                            <input type="password" name="campo_confirma_senha" value="" id="campo_confirma_senha" class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-12">
                            <label for="">Ultima alteração</label>
                            <input type="text" value="<?echo$data_convert?>" name="campo_dataUltima" id="campo_email" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" class="btn btn-primary col-md-12" id="btnEnvia">Alterar</button>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" class="btn btn-danger col-md-12" id="btnEnvia">Cancelar</button>
                            </div>
                            </div>
                            
                    </fieldset>
                </form>
            </div>
            <div class="col-md-4 "></div>
        </div>
    </div>
    </div>
</body>