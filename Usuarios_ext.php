<?php
session_start();
if(!isset($_SESSION['id_usuario']))
{
	header("location:index.php");
	exit();
} 

?>
<?php
require_once 'classes/Usu.php';
$p = new Usu("sistemalogin","localhost","root",""); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="CSS/usuarios.css">
	 <link rel="stylesheet" type="text/css" href="CSS/Home.css">
</head>
<body>
	<nav id="menu">
    <ul>
        <li><a href="#">HOME</a></li>
        <li><a href="Usuarios_ext.php">USUARIOS</a></li>
        <li><a href="areaPrivada.php">LIVROS</a></li>
        <li><a href="emprestimoExterno.php">EMPRESTIMOS</a></li>
        <li><a href="#">DEVOLUÇÃO</a></li>
        <li><input type="text" name="" id="pesquisar" placeholder="pesquisar"></li>
    </ul>
</nav>
	<?php
	if(isset($_POST['nome']))
	{
		//-----------editar--------
		if(isset($_GET['id_up']) && !empty($_GET['id_up']))
		{
		  $id_upd = addslashes($_GET['id_up']);
		  $nome = addslashes($_POST['nome']);
          $cpf = addslashes($_POST['cpf']);
          $telefone = addslashes($_POST['telefone']);
          $endereco = addslashes($_POST['endereco']);
          $cidade = addslashes($_POST['cidade']);
          $rg = addslashes($_POST['rg']);
          if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($endereco) && !empty($cidade) && !empty($rg))
     {
        $p->atualizarDados($id_upd,$nome,$cpf,$telefone,$endereco,$cidade,$rg);
        header("location: Usuarios_ext.php");
        
        
     }
     else
     {
        echo "preencha todos os campos!";
          }


		}
     
     
	 
         //-----------cadastrar---------
		else
		{
          $nome = addslashes($_POST['nome']);
          $cpf = addslashes($_POST['cpf']);
          $telefone = addslashes($_POST['telefone']);
          $endereco = addslashes($_POST['endereco']);
          $cidade = addslashes($_POST['cidade']);
          $rg = addslashes($_POST['rg']);
          if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($endereco) && !empty($cidade) && !empty($rg))
     {
        if(!$p->cadastrarUsu($nome,$cpf,$telefone,$endereco,$cidade,$rg))
        
        {
         echo "Usuario ja cadastrado";
        }
     }
     else
     {
        echo "preencha todos os campos!";
     }
		}
     
     
	} 
	?>
	<?php
	if(isset($_GET['id_up']))
	{
		$id_update = addslashes($_GET['id_up']);
		$res = $p->buscarDadosUsu($id_update);
	} 
	?>
	<section id="esquerda">
		<form method="POST">
			<h2>CADASTRAR USUARIOS</h2>
			<label for="nome">NOME</label>
			<input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>">
			<label for="cpf">CPF</label>
			<input type="text" name="cpf" id="cpf" value="<?php if(isset($res)){echo $res['cpf'];}?>">
			<label for="telefone">TELEFONE</label>
			<input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];}?>">
			<label for="endereco">ENDEREÇO</label>
			<input type="text" name="endereco" id="endereco" value="<?php if(isset($res)){echo $res['endereco'];}?>">
			<label for="cidade">CIDADE</label>
			<input type="text" name="cidade" id="cidade" value="<?php if(isset($res)){echo $res['cidade'];}?>">
			<label for="rg">RG</label>
			<input type="int" name="rg" id="rg" value="<?php if(isset($res)){echo $res['rg'];}?>">
			<input type="submit" 
			value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
	
		</form>
	</section>
	<section id="direita">
		
		<table>
			<tr id="titulo">
				<td>NOME</td>
				<td>CPF</td>
				<td>TELEFONE</td>
				<td>ENDERECO</td>
				<td>CIDADE</td>
				<td colspan="2">RG</td>
				
				

			</tr>
		<?php
		$dados = $p->buscarDados(); 
		if(count($dados) > 0)
		{
             for ($i=0; $i < count($dados); $i++) 
             { 
             	echo "<tr>";
             foreach ($dados[$i] as $k => $v) 
             {
             	if($k != "id")
             	{
                    echo "<td>".$v."</td>";
             	}
              }
              ?>
              <td>
              	<a href="Usuarios_ext.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
              	<a href="Usuarios_ext.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
              </td>
              <?php
              echo "</tr>";
            }
            
            
            
		   }else{
		   	echo "Ainda não há pessoa cadastradas";
		   }
		?>
		</table>
	</section>
</body>
</html>
<?php
  if(isset($_GET['id']))
  {
  	$id_usu = addslashes($_GET['id']);
  	$p->excluirUsu($id_usu);
  	header("location: usuarios_ext.php");
  } 
?>

