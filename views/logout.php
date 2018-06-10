<?php
 session_start();

  unset($_SESSION['email']);
 unset($_SESSION['usuario']);
 unset($_SESSION['status']);
 unset($_SESSION['senha']);
 unset($_SESSION['foto']);

 if(session_destroy())
 {
  header("Location: /");
 }
?>