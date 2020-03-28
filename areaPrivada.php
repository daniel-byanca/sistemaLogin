<?php
session_start();
if(!isset($_SESSION['id_usuario']))
{
	header("location:index.php");
	exit();
} 

?>
<?php
require_once 'classes/Livro.php';
$p = new Livro("sistemalogin","localhost","root",""); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro de Livros</title>
	<link rel="stylesheet" href="CSS/area_Privada.css">
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
	if(isset($_POST['autor']))
	{
		//-----------editar--------
		if(isset($_GET['id_up']) && !empty($_GET['id_up']))
		{
		  $id_upd = addslashes($_GET['id_up']);
		  $autor = addslashes($_POST['autor']);
          $titulo = addslashes($_POST['titulo']);
          $pagina = addslashes($_POST['pagina']);
          $editora = addslashes($_POST['editora']);
          $ano = addslashes($_POST['ano']);
          if(!empty($autor) && !empty($titulo) && !empty($pagina) && !empty($editora) && !empty($ano))
     {
        $p->atualizarDados($id_upd,$autor,$titulo,$pagina,$editora,$ano);
        header("location: areaPrivada.php");
        
        
     }
     else
     {
        echo "preencha todos os campos!";
          }


		}
     
     
	 
         //-----------cadastrar---------
		else
		{
          $autor = addslashes($_POST['autor']);
          $titulo = addslashes($_POST['titulo']);
          $pagina = addslashes($_POST['pagina']);
          $editora = addslashes($_POST['editora']);
          $ano = addslashes($_POST['ano']);
          if(!empty($autor) && !empty($titulo) && !empty($pagina) && !empty($editora) && !empty($ano))
     {
        if(!$p->cadastrarLivro($autor,$titulo,$pagina,$editora,$ano))
        
        {
         echo "Livro ja cadastrado";
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
		$res = $p->buscarDadosLivro($id_update);
	} 
	?>
	<section id="esquerda">
		<form method="POST">
			<h2>CADASTRAR LIVROS</h2>
			<label for="autor">Autor</label>
			<input type="text" name="autor" id="autor" value="<?php if(isset($res)){echo $res['autor'];}?>">
			<label for="titulo">Titulo</label>
			<input type="text" name="titulo" id="titulo" value="<?php if(isset($res)){echo $res['titulo'];}?>">
			<label for="pagina">Pagina</label>
			<input type="number" name="pagina" id="pagina" value="<?php if(isset($res)){echo $res['pagina'];}?>">
			<label for="editora">Editora</label>
			<input type="text" name="editora" id="editora" value="<?php if(isset($res)){echo $res['editora'];}?>">
			<label for="ano">Ano</label>
			<input type="date" name="ano" id="ano" value="<?php if(isset($res)){echo $res['ano'];}?>">
			<input type="submit" 
			value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
		</form>
	</section>
	<section id="direita">
		
		<table>
			<tr id="titulo">
				<td>AUTOR</td>
				<td>TÍTULO</td>
				<td>PÁGINAS</td>
				<td>EDITORA</td>
				<td colspan="2">ANO</td>

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
              	<a href="areaPrivada.php?id_up=<?php echo $dados[$i]['id'];?>">Editar</a>
              	<a href="areaPrivada.php?id=<?php echo $dados[$i]['id'];?>">Excluir</a>
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
  	$id_livro = addslashes($_GET['id']);
  	$p->excluirLivro($id_livro);
  	header("location: areaPrivada.php");
  } 
?>
<a href="sair.php" style="text-align: right;"> SAIR </a>
<a href="home.php">volta a página inicial</a>