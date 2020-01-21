<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: ../Views/login.php?erro=1');
  }
    require_once('../Cabecalhos/nav-bar.php');
?>
<body>
    <div class="" style="margin-top: 150px; margin-left: 500px;">
      <img src="../imagens/fr.png" alt="">
    </div>
</body>