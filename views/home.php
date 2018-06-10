  <script src="../app.js"></script>
      <script src="../controllers/controllers.js"></script>
     <script src="../controllers/validarlogin.js"></script>

<?php 
session_start();
include_once '../class/users.php';
?>

<?php
if ($_SESSION == null || !empty($_SESSION['msg']) || !empty($_SESSION['errologin'])){ 
echo "<div >";

      if (!empty($_SESSION['msg'])){
         echo "<div class='alert alert-info'>
                 <strong>Atenção! </strong>";echo $_SESSION['msg']; echo" </div>";

                 unset( $_SESSION['msg'] );


         
      }elseif(!empty($_SESSION['errologin'])){
            echo "<div class='alert alert-danger'>
                 <strong>Atenção! </strong>";echo $_SESSION['errologin']; echo" </div>";

                 unset( $_SESSION['errologin'] );
      }
      /** INÍCIO DOS FORMULÁRIOS **/
      /** FORMULÁRIO DE LOGIN **/
     echo "
    <div class='container' id='login-from'>
         <h2>Formulário de Login</h2>
    
      <form method='post'  action='/views/login-autenticar.php'>
         
          <div class='form-group row'>
           
            <label for='email' class='col-sm-2 col-form-label'>Email:</label>
           
            <div class='col-sm-10'>
            <input type='email' class='form-control' id='email' name='email' placeholder='Entre com Email válido.'>
            </div>
         </div>
         
         <div class='form-group row'>
            <label for='pwd' class='col-sm-2 col-form-label'>Senha:</label>   
            <div class='col-sm-10'>
            <input type='password' class='form-control' id='senha' name='senha' placeholder='Entre com uma Senha' aria-describedby='passwordHelpBlock'  pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' title='Sua senha deve conter no minimo 6 caracteres, conter ao menos uma letra maiúscula e conter ao menos um número.'>
              </div>
          </div>
          
          <button type='submit' class='btn btn-primary'>Entrar</button>
    </div>
  </form>
  <!-- FORMULÁRIO DE CADASTRO -->
   <div class='container' id='registro-from'>
   	   <h2>Formulário de Registro</h2>
   			<form method='post' action='/views/usr-register.php'>
        <div class='form-grouo'>
            <label for='usr'>Nome Completo:</label>
            <input type='text' class='form-control' id='nome' name='nome' placeholder='Entre com seu Nome Completo'>
          </div>
   				<div class='form-grouo'>
   					<label for='usr'>Usuário:</label>
   					<input type='text' class='form-control' id='usuario' name='usuario' placeholder='Entre com Usuário'>
   				</div>
   				<div class='form-grouo'>
   					<label for='email'>Email:</label>
   					<input type='email' class='form-control' id='email' name='email' placeholder='Entre com Email válido.'>
   				</div>
   				<div class='form-grouo'>
   					<label for='pwd'>Senha:</label>
   					<input type='password' class='form-control' id='senha' name='senha' placeholder='Entre com uma Senha' aria-describedby='passwordHelpBlock'  pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' title='Sua senha deve conter no minimo 6 caracteres, conter ao menos uma letra maiúscula e conter ao menos um número.'>
   						<small id='passwordHelpBlock' class='form-text text-muted'>
						  Sua senha deve conter no minimo 6 caracteres, conter ao menos uma letra maiúscula e conter ao menos um número.
						</small>
   				</div>
   				
					<button type='submit' class='btn btn-primary'>Cadastrar</button>

   			</form>
   </div>

</div>
";

}
 else{
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$usuario = $_SESSION['usuario'];
$status = $_SESSION['status'];
$senha = $_SESSION['senha'];
$foto = $_SESSION['foto'];



?>

<!-- FORMULÁRIO DO PERFIL -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
       <br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Olá <?php echo $nome; ?>, seja bem vindo!</h3> 
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $foto; ?>" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nome:</td>
                        <td><?php echo $nome; ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td>
                      </tr>
                      <tr>
                        <td>Usuário:</td>
                        <td><?php echo $usuario; ?></td>
                      </tr>
                      </tr>
                    </tbody>
                  </table>
                  </div>
              </div>
            </div>
                 <div class="panel-footer">
                           <form method='post' action='/views/logout.php'>
                                <button type='submit' class='btn btn-primary'> <i class="glyphicon glyphicon-remove"></i> Sair</button>
                         </form>
                        </span>
                    </div>
          </div>
        </div>
      </div>
    </div>
<?php 
}
?>




