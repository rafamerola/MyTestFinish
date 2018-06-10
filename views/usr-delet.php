<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/db.php';
include_once '../class/users.php';

$database = new Db();
$db = $database->getConnection();

$usuarios = new Usuarios($db);

$usuarios->id = filter_input(INPUT_GET, 'id');

if ($usuarios->delete()) {
    echo '{';
    echo '"message": "Usuário deletado com sucesso."';
    echo '}';
}

else {
    echo '{';
    echo '"message": "Usuário não pode ser excluido."';
    echo '}';
}
?>