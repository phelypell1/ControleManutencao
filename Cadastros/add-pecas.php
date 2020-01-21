<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../Views/login.php?erro=1');
}
require_once('../Cabecalhos/nav-bar.php');
?>

<body>
    <br>
    <div class="container">
        <div class="col-md-12">
        <form action="../Controllers/add-img.php" method="post" enctype="multipart/form-data" id="add-img">
            <fieldset class="fieldsetCad4">
                <legend class="legendCad4">Cadastrar Imagens</legend>
                <div class="row">
                    <!--<div class="form-group col-md-2">
                        <label for="">Nome para imagem</label>
                        <input name="label_code" type="text" class="form-control">
                    </div>-->
                    <div class="form-group col-md-2">
                        <label for="">Patrimonio</label>
                        <input name="label_patrimonio" type="text" class="form-control">
                    </div>
                </div>
                    <input type="file" name="abc" id="arquivo" required>
                    <button type="submit" value="adicionar" id="btn-add" class="btn btn-danger">add</button>
                </form>
            </fieldset>
            <br>

        </div>

    </div>

</body>