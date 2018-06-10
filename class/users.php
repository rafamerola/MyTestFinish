<?php 

class Usuarios {

    private $conn;
    private $table_name = "myt_usr";
    public $id;
    public $usuario;
    public $email;
    public $senha;
    public $status;
    public $foto;
    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT u.usr_id, u.usr_usuario, u.usr_email, u.usr_senha, u.usr_status, u.usr_foto
            FROM
                " . $this->table_name . " u
            ORDER BY
                u.usr_id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function verificacao($email,$hash) {
        
        $query = "SELECT u.usr_nome,u.usr_usuario,u.usr_foto,u.usr_email, u.usr_status, u.usr_hash, u.usr_status
            FROM
                " . $this->table_name . " u WHERE u.usr_email = '".$email."' AND u.usr_hash = '".$hash."' AND u.usr_status = '0'";
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


     function create() {
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                usr_nome = :nome, usr_usuario=:usuario, usr_email=:email, usr_senha = MD5(:senha), usr_status=:status,usr_foto=:foto, usr_hash =:hash";
        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->foto = htmlspecialchars(strip_tags($this->foto));
        $this->hash = htmlspecialchars(strip_tags($this->hash));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":foto", $this->foto);
        $stmt->bindParam(":hash", $this->hash);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function ativarconta($email,$hash) {

          $query = "UPDATE
                " . $this->table_name . " u SET u.usr_status ='1' WHERE u.usr_email = '$email' AND u.usr_hash = '$hash' AND u.usr_status = '0'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        echo $query;
        return $stmt;
    }

      function update() {
        $query = "UPDATE
                " . $this->table_name . "
            SET
                usr_usuario = :usuario, usr_email = :email, usr_senha =:senha, usr_status = :status, usr_foto =:foto
            WHERE
                usr_id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->usuario = htmlspecialchars(strip_tags($this->usuario));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->foto = htmlspecialchars(strip_tags($this->foto));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':foto', $this->foto);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE usr_id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

     function checarlogin($email,$senha) {
        $query = "SELECT u.usr_id,u.usr_nome, u.usr_usuario, u.usr_email, u.usr_senha, u.usr_status, u.usr_foto, u.usr_hash
            FROM
                " . $this->table_name . " u WHERE u.usr_email = '$email' AND u.usr_senha = MD5('$senha') AND u.usr_status = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function getAvatar($mail) {
    $email   = $mail;
    $default = '_img/sem-imagem-perfil.png';
    $size    = 25;
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) .
    "?d=" . urlencode( $default ) . "&s=" . $size;
    return $grav_url;
    }

}

?>