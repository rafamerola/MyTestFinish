<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
session_start();

include_once '../config/db.php';
include_once '../class/users.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$usuario = isset($_POST['usuario']) ? $_POST['usuario']: '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

/** PEGAR IMAGEM DO GRAVATAR **/
$default = "../imgs/avatar.png";
$size = 40;
$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

$foto = $grav_url;
$hash = md5( rand(0,1000) );
$status = 0;

/** CONFIRMAÇÃO POR EMAIL **/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);                              
try {
   
    $mail->SMTPDebug = 2;                                 
    $mail->isSMTP();                                     
    $mail->Host = 'Host';  
    $mail->SMTPAuth = true;                             
    $mail->Username = 'User';     
    $mail->Password = 'Senha';                          
    $mail->SMTPSecure = 'ssl';                            
    $mail->Port = 465;                                   

  
    $mail->setFrom('', 'Mailer');
    $mail->addAddress($email, $nome);            
    $mail->addReplyTo('', 'Information');
    

   
    $mail->isHTML(true);                                
    $mail->Subject = 'Verificar email';
    $mail->Body    = 'Olá, recebemos uma inscrição a partir deste email, se for você mesmo clique no link abaixo para confirmar o seu email:</br>
    	 <b>http://mytest.juckmusic.com/views/autorizar.php?email='.$email.'&hash='.$hash.'</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

/** CADASTRO **/
$database = new Db();
$db = $database->getConnection();
$usuarios = new Usuarios($db);
$data = json_decode(file_get_contents("php://input", true));

$usuarios->nome = $nome;
$usuarios->usuario = $usuario;
$usuarios->email = $email;
$usuarios->senha = $senha;
$usuarios->status = $status;
$usuarios->foto = $foto;
$usuarios->hash = $hash;

if ($usuarios->create()) {
    $_SESSION['msg'] = 'Sua conta foi criada, será necessário ativação através de seu email.';
	header("Location: /");
    echo '{';
    echo '"message": "Usuário Criado com Sucesso."';
    echo '}';
}

else {
    echo '{';
    echo '"message": "Não é permitido criar usuário."';
    echo '}';
}

?>