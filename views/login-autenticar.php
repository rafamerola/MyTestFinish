<?php 
session_start();
include_once '../config/db.php';
include '../class/users.php';


$database = new Db();
$db = $database->getConnection();
$users = new Usuarios($db);


$stmt = $users->checarlogin($_POST['email'],$_POST['senha']);
$num = $stmt->rowCount();

if ($num > 0) {
    $users_arr = array();
    $users_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $_SESSION['nome'] = $row['usr_nome'];
        $_SESSION['usuario'] = $row['usr_usuario'];
        $_SESSION['email'] = $row['usr_email'];
        $_SESSION['status'] = $row['usr_status'];
        $_SESSION['foto'] = $row['usr_foto'];
        $_SESSION['senha'] = $row['usr_senha'];
        $users_item = array(
            "id" => $row['usr_id'],
            "nome" => $row['usr_nome'],
            "usuario" => $row['usr_usuario'],
            "email" => $row['usr_email'],
            "senha" => $row['usr_senha'],
            "status" => $row['usr_status'],
            "foto" => $row['usr_foto'],
            "hash" => $row['usr_hash'],
        );
        array_push($users_arr["records"], $users_item);
    }

    header("Location: /");
    echo 1;
    echo json_encode($users_arr);
} else {

    $_SESSION['errologin'] = 'Algo deu errado! Login ou senha está incorreto.';
    header("Location: /");
    echo json_encode(
            array("message" => "Nenhum usuário encontrado.")
    );
   echo 0;
}


?>

