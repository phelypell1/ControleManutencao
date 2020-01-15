<?php
require_once('../Connections/Conexao.php');
    session_start();
    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }
    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql(); 
   //fakepath
    if(isset($_FILES['abc'])){
    $extensao = strtolower(substr($_FILES['abc']['name'], -4));
    $novo_nome = "img".md5(time()) . $extensao;
    $diretorio = "../imagensOs/";
    //irá mover imagem para pasta.
    move_uploaded_file($_FILES['abc']['tmp_name'], $diretorio.$novo_nome);
    $query ="insert imagens (nomeImg, dataImg) values('$novo_nome', NOW())";
    if(mysqli_query($link, $query)){
        header('Location: ../Views/cadastrar-os.php');
    }else{
        echo mysqli_error($link);
    };
}else{
    var_dump($_FILES);
     echo $_SERVER['REQUEST_METHOD'];
}
?>