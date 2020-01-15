<?php
session_start();
if(!isset($_SESSION['login'])){
      header('Location: ../Viewslogin.php?erro=1');
  }
require_once('../Cabecalhos/nav-bar.php');
$id_sessao = $_SESSION['id'];
$status = isset($_GET['status']) ? $_GET['status'] : 0;
?>
<?
require_once('../Connections/ConexaoUser.php');


$ObjDB = new DBUser();
$link = $ObjDB->connecta_mysql();

$query = "select U.IdUsuario, L.Login, P.Perfil, U.Nome, U.EhAtivo, DATE_FORMAT(U.DataCadastro, '%d-%m-%Y %H:%i:%s')as dataf, U.Email, U.Cargo, U.Regiao ";
$query .= "from Usuario as U ";
$query .= "inner join Login as L on L.idLogin = U.IdLogin ";
$query .= "inner join Perfil as P on P.IdPerfil = U.IdPerfil ";
$query .= "where U.IdUsuario = '$id_sessao '";

$result = mysqli_query($link, $query);
if ($result) {
    while ($registro = mysqli_fetch_array($result)) {
        $id = $registro['IdUsuario'];
        $login = $registro['Login'];
        $perfil = $registro['Perfil'];
        $nome = $registro['Nome'];
        $EhAtivo = $registro['EhAtivo'];
        if ($EhAtivo == 1) {
            $ativo = 'Ativo';
        } else {
            $ativo = "Inativo";
        }
        $data = $registro['dataf'];
        $email = $registro['Email'];
        $cargo = $registro['Cargo'];
        $regiao = $registro['Regiao'];
    }
}
?>
<body>
    <div class="container border top">
        <div class="row">
            <form action="../Controllers/update_meusdados.php" method="post" class="col">
                <div class="form-row">
                    <div class="form-group col-md-12">
                    <?
                        if ($status == 1) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>ATENÇÃO!</strong> Seus dados foram atualizados com sucesso !
                   <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>';
                        }else if($status == 2){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>ATENÇÃO!</strong> Error
                   <button id="myAlert" type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>';
                        }

                        ?>
                        <h4>Meus Dados</h4>

                        <hr>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="Cód Usuário">Cód</label>
                        <input type="text" class="form-control" name="campo_codigo" id="campo_codigo" value="<? echo $id ?>" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Cód Usuário">Nome Usuário</label>
                        <input type="text" class="form-control" name="campo_login" id="campo_nome" value="<? echo $login ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Cód Usuário">Perfil Acesso</label>
                        <input type="text" class="form-control" name="campo_perfil" id="campo_perfil" value="<? echo $perfil ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Cód Usuário">Nome Completo</label>
                        <input type="text" class="form-control" name="campo_nome" id="campo_nome" value="<? echo $nome ?>">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="Cód Usuário">Status</label>
                        <input type="text" class="form-control" name="campo_ativo" id="campo_ativo" value="<? echo $ativo ?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Cód Usuário">Data Cadastro</label>
                        <input type="text" class="form-control" name="campo_data" id="campo_data" value="<? echo $data ?>" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="Cód Usuário">Email</label>
                        <input type="e-mail" class="form-control" name="campo_email" id="campo_email" value="<? echo $email ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Cód Usuário">Cargo</label>
                        <input type="e-mail" class="form-control" name="campo_cargo" id="campo_cargo" value="<? echo $cargo ?>" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="Cód Usuário">Região</label>
                        <input type="e-mail" class="form-control" name="campo_regiao" id="campo_regiao" value="<? echo $regiao ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="btn-group col-md-2 btn-config-1">
                        <button type="submit" class="btn btn-primary" id="btn-enviar">Alterar dados</button>
                    </div>
                    <div class="btn-group col-md-2 btn-config">
                        <a href="../Views/home.php" class="btn btn-danger">Sair</a>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
</body>