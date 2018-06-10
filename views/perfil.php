 <?php

 session_start();
 if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location:index.html');
    }
 
$email = $_SESSION['email'];
$usuario = $_SESSION['usuario'];
$status = $_SESSION['status'];
$senha = $_SESSION['senha'];
$foto = $_SESSION['foto'];
 ?>
<html>
<head>
	
<title>Seja bem vindo <?php echo $usuario;  ?></title>

</head>
<body>
	
<?php 

echo $email;
?>
</br>
<?php
echo $usuario;
?>
</br>
<?php
echo $status;
?>
</br>
<?php 
echo $foto;



?>

</body>
	

</html>
