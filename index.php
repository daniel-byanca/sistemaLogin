<?php
require_once "classes/usuarios.php";

$u = new usuario 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projeto login</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilo_index.css">
	
</head>
<body>
	<div id="corpo-form">
		
	<h1>Entrar</h1>
<form method="POST">
	<input type="email" name="email" placeholder="usuario">
	<input type="password" name="senha" placeholder="senha">
	<input type="submit" value="Acessar">
	<a href="cadastrar.php">Ainda não é inscrito?<strong>cadastre-se</strong></a>
</form>
	</div>
	<?php 
	if(isset($_POST['email']))
	{
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	if(!empty($email) && !empty($senha))
	{
	$u->conectar("sistemalogin", "localhost", "root", "");
	if ($u->msgErro == "")
	 {
	 if($u->logar($email,$senha))
	 {
		/*header("location:areaPrivada.php");*/
		header("location:home.php");
	 }
	 else
	 {
	 	echo "Email e/ou senha incorretos!";
	   }
     }
     else
     {
     	echo "Erro:".$u->msgErro;
     }

	}else
	{
		echo "Preencha todos os campos";
	}
}
	?>
</body>
</html>
	
       
	
     
	

       

	

	
	