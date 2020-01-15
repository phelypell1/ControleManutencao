<?php
session_start();
if(!isset($_SESSION['login'])){
  header('Location: ../Views/login.php?erro=1');
  }
    require_once('../Cabecalhos/nav-bar.php');
?>
