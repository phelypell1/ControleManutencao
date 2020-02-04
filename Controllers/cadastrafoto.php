<?php
require_once('../Connections/ConexaoUser.php');
    session_start();
    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }
    $ObjDB = new DBUser();
    $link = $ObjDB -> connecta_mysql(); 
    $nome_novo = $_SESSION['login'];
    $idUser = $_SESSION['id'];
    

   //fakepath
    if(isset($_FILES['foto'])){
    $extensao = strtolower(substr($_FILES['foto']['name'], -4));
    $novo_nome = $nome_novo. $extensao;
    $diretorio = "../imagensPerfil/";
    //irá mover imagem para pasta.
    move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$novo_nome);
    $query ="update Usuario set Imagem = '$diretorio$novo_nome' where idUsuario = '$idUser'";
    if(mysqli_query($link, $query)){
        //header('Location: ../Cadastros/add-pecas.php');
        header('Location: ../Views/alterafoto.php?status=1');
    }else{
        echo mysqli_error($link);
    };
}else{
    var_dump($_FILES);
    echo $idUser;
    echo $nome_novo;
     echo $_SERVER['REQUEST_METHOD'];
}
?>