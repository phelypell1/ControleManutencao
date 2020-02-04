<?
session_start();
require_once("../Cabecalhos/nav-bar.php");
$status = isset($_GET['status']) ? $_GET['status'] : 0;
?>

<div class="container border top">
    <form action="../Controllers/cadastrafoto.php" method="post" enctype="multipart/form-data">
            <div class="container">
            <?php
                if ($status == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>ATENÇÃO!</strong> Imagens atualizada com sucesso! <br> Para visualisar faça logof.
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
                } 
                ?>
                    <div class="form-group">
                    <label for="">Adicionar imagem:</label>
                    <input type="file" class="fomr-control form-control-sm" name="foto">
                    <button type="submit" value="adicionar" id="btn-add" class="btn btn-danger">add</button>
                    </div>
            </div>  
        </form>
</div>