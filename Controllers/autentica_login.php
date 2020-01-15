<?php
    //sempre iniciar o session;

    session_start();
      require_once('../Connections/ConexaoUser.php');
      $usuario = $_POST['login'];
      $passwords = $_POST['senha'];

      $ObjDB = new DBUser();
      $link = $ObjDB -> connecta_mysql();

      //$sql = "select idLogin, login, email, ehAtivo, nivel_acesso from logins where login='$usuario'  and pass='$passwords' and ehAtivo = '1'";
      $sql = "select L.IdLogin, L.Login, L.Senha, U.IdUsuario, U.Nome, U.Email, U.Cargo, U.Imagem, P.Perfil from Login AS L INNER JOIN ";
      $sql.= " Usuario AS U ON U.IdLogin = L.IdLogin INNER JOIN Perfil AS P ON P.IdPerfil = U.IdPerfil WHERE L.Login ='$usuario' AND ";
      $sql.=" L.Senha ='$passwords' AND U.EhAtivo = true";
      
      $result = mysqli_query($link, $sql);

      if($result){
         $dados = mysqli_fetch_array($result);
         if(isset($dados['Login'])){
             
            $_SESSION['id'] = $dados['IdLogin'];
            $_SESSION['login']  = $dados['Login'];
            $_SESSION['username'] = $dados['Nome'];
            $_SESSION['useremail'] = $dados['Email'];
            $_SESSION['ehAtivo'] = $dados['EhAtivo'];
            $_SESSION['userperfil']  = $dados['Perfil'];
            

             header('location: ../Views/home.php');
         
            if($_SESSION['EhAtivo'] == 'True'){
            header('location: ../Views/home.php');
            }

         }else{
             header('location: ../Views/login.php?erro=1');
         }
      }else{
          echo 'ERROR ! <br>'.mysqli_error($link);
          
      }

?>