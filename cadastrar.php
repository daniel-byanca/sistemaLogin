<?php 
require_once 'classes/usuarios.php';
$u = new usuario
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projeto login</title>
	<link rel="stylesheet" type="text/css" href="CSS/index.css">
</head>
<body>
	<div id="corpo-form-Cad">
		
	<h1>Cadastrar</h1>
<form method="POST">
	<input type="text" name="nome" placeholder="Nome completo">
	<input type="text" name="telefone" placeholder="telefone">
	<input type="email" name="email" placeholder="usuario">
	<input type="password" name="senha" placeholder="senha">
	<input type="password" name="confSenha" placeholder=" Confirmar senha">
	<input type="submit" value="Cadastrar">
	
</form>
	</div>
	<?php 
	if(isset($_POST['nome']))
	{

	$nome = addslashes($_POST['nome']);
	$telefone = addslashes($_POST['telefone']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmarSenha = addslashes($_POST['confSenha']);
	if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
	{
     $u->conectar("sistemalogin", "localhost", "root", "");
     if($u->msgErro == "")
     {
       if($senha == $confirmarSenha)
       {
       if($u->cadastrar($nome,$telefone,$email,$senha))
       {
       	?>
       	<div id="msg-sucesso">
         cadastrado com sucesso!
     </div>
         <?php
       }
       else{
       	?>
       	<div class="msg-erro">
       	email cadastrado!
       </div>
       	<?php
       }
       }else
       {
       	?>
       	<div class="msg-erro">
       senha e confirmar senha nao corresponde;
       	</div>
       <?php
       		
       }

     }else{
     	?>
     	<div class="msg-erro">
     	<?php echo "Erro:". $u->msgErro;?>
     </div>
     	<?php
     }
	}else
	{
		?>
		<div class="msg-erro">
		Preencha todos os campos;
	</div>
		<?php
	}
	}
	?>
  <a href="index.php">Voltar</a>
</body>
</html>