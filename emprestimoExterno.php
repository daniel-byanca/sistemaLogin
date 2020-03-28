<?php
session_start();
if(!isset($_SESSION['id_usuario']))
{
	header("location:index.php");
	exit();
} 

?>
<?php
require_once 'classes/Emprestimo.php';
$p = new Emprestimo("sistemalogin","localhost","root",""); 
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
		  $cpf = addslashes($_POST['cpf']);
          $nome = addslashes($_POST['nome']);
          $livro = addslashes($_POST['livro']);
          $dataEmprestimo = addslashes($_POST['dataEmprestimo']);
          $dataEmtrega = addslashes($_POST['dataEmtrega']);
          if(!empty($cpf) && !empty($nome) && !empty($livro) && !empty($dataEmprestimo) && !empty($dataEmtrega))
     {
        $p->atualizarDados($id_upd,$cpf,$nome,$livro,$dataEmprestimo,$dataEmtrega);
        header("location: emprestimoExterno.php");
        
        
     }
     else
     {
        echo "preencha todos os campos!";
          }


		}
     
     
	 
         //-----------cadastrar---------
		else
		{
          $cpf = addslashes($_POST['cpf']);
          $nome = addslashes($_POST['nome']);
          $livro = addslashes($_POST['livro']);
          $dataEmprestimo = addslashes($_POST['dataEmprestimo']);
          $dataEmtrega = addslashes($_POST['dataEmtrega']);
          if(!empty($cpf) && !empty($nome) && !empty($livro) && !empty($dataEmprestimo) && !empty($dataEmtrega))
     {
        if(!$p->cadastrarEmprestimo($cpf,$nome,$livro,$dataEmprestimo,$dataEmtrega))
        
        {
         echo "Emprestimo frito com suscesso";
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
		$res = $p->buscarDadosEmprestimo($id_update);
	} 
	?>
	<section id="esquerda">
		<form method="POST">
			<h2>CADASTRAR LIVROS</h2>
			<label for="cpf">CPF</label>
			<input type="text" name="cpf" id="cpf" value="<?php if(isset($res)){echo $res['cpf'];}?>">
			<label for="nome">NOME</label>
			<input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>">
			<label for="livro">LIVRO</label>
			<input type="text" name="livro" id="livro" value="<?php if(isset($res)){echo $res['livro'];}?>">
			<label for="dataEmprestimo">DATA EMPRÉSTIMO</label>
			<input type="date" name="dataEmprestimo" id="dataEmprestimo" value="<?php if(isset($res)){echo $res['dataEmprestimo'];}?>">
			<label for="dataEmtrega">DATA EMTREGA</label>
			<input type="date" name="dataEmtrega" id="dataEmtrega" value="<?php if(isset($res)){echo $res['dataEmtrega'];}?>">
                
			<input type="submit" 
			value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
		</form>
	</section>
	<section id="direita">
		
		<table>
			<tr id="titulo">
				<td>CPF</td>
				<td>NOME</td>
				<td>LIVRO</td>
				<td>DATA EMPRÉSTIMO</td>
				<td colspan="2">DATA ENTREGA</td>
			   

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
              	<a href="emprestimoExterno.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
              	<a href="emprestimoExterno.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
              </td>
              <?php
              echo "</tr>";
            }
            
            
            
		   }else{
		   	echo "Ainda não há livros emprestados";
		   }
		?>
		</table>
	</section>
</body>
</html>
<?php
  if(isset($_GET['id']))
  {
  	$id_livro = addslashes($_GET['id']);
  	$p->excluirEmprestimo($id_livro);
  	header("location: emprestimoExterno.php");
  } 
?>
<a href="sair.php" style="text-align: right;"> SAIR </a>
<a href="home.php">volta a página inicial</a>