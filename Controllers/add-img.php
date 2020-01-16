<?php
require_once('../Connections/Conexao.php');
    session_start();
    if(isset($_SESSION['Login'])){
        header('Location: ../Views/login.php?erro=1');
    }
    $ObjDB = new DB();
    $link = $ObjDB -> connecta_mysql(); 
    $nome_novo = $_POST['label_code'];
    $patrimonio = $_POST['label_patrimonio'];
    $date = date('Ymd');

   //fakepath
    if(isset($_FILES['abc'])){
    $extensao = strtolower(substr($_FILES['abc']['name'], -4));
    $novo_nome = $patrimonio.$date . $extensao;
    $diretorio = "../imagensOs/";
    //irá mover imagem para pasta.
    move_uploaded_file($_FILES['abc']['tmp_name'], $diretorio.$novo_nome);
    $query ="insert imagens (numPatrimonio, nomeImg, dataImg) values('$patrimonio','$novo_nome', NOW())";
    if(mysqli_query($link, $query)){
        header('Location: ../Cadastros/add-pecas.php');
    }else{
        echo mysqli_error($link);
    };
}else{
    var_dump($_FILES);
     echo $_SERVER['REQUEST_METHOD'];
}
?>