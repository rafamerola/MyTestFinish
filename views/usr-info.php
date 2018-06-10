<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/db.php';
include_once '../class/users.php';

$database = new Db();
$db = $database->getConnection();

$users = new Usuarios($db);

$stmt = $users->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $users_arr = array();
    $users_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $users_item = array(
            "id" => $row['usr_id'],
            "usuario" => $row['usr_usuario'],
            "email" => $row['usr_email'],
            "senha" => $row['usr_senha'],
            "status" => $row['usr_status'],
            "foto" => $row['usr_foto']
        );
        array_push($users_arr["records"], $users_item);
    }
    echo json_encode($users_arr);
} else {
    echo json_encode(
            array("message" => "Nenhum usuário encontrado.")
    );
}
?>