<?php 

include_once '../config/db.php';
include_once '../class/users.php';
session_start();
$database = new Db();
$db = $database->getConnection();

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = $_GET['email'];
    $hash = $_GET['hash'];


$database = new Db();
$db = $database->getConnection();
$users = new Usuarios($db);

$stmt = $users->verificacao($email,$hash);
$num = $stmt->rowCount();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
 $_SESSION['nome'] = $row['usr_nome'];
        $_SESSION['usuario'] = $row['usr_usuario'];
        $_SESSION['email'] = $row['usr_email'];
        $_SESSION['status'] = $row['usr_status'];
        $_SESSION['foto'] = $row['usr_foto'];
        $_SESSION['senha'] = $row['usr_senha'];

}
if($num > 0){
       
       $stmt = $users->ativarconta($email,$hash);
        header("Location: /");
    }else{
        header("Location: /ativacaofalha");
    }

}else{
    header("Location: /ativacaofalha");

}

?>