<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/db.php';
include_once '../class/users.php';

$database = new Db();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$data = json_decode(file_get_contents("php://input", true));

$usuarios->id = $data->id;
$usuarios->usuario = $data->usuario;
$usuarios->email = $data->email;
$usuarios->senha = $data->senha;
$usuarios->status = $data->status;
$usuarios->foto = $data->foto;

if ($usuarios->update()) {
    echo '{';
    echo '"message": "Usuário alterado com sucesso."';
    echo '}';
}

else {
    echo '{';
    echo '"message": "Não foi possível alterar o usuário."';
    echo '}';
}

?>