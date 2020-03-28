<?php 
class Livro{
	private $pdo;
  public function __construct($dbname, $host, $user, $password)
  {
  	try
  	{
    $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password	);
  	}
  	catch(PDOException $e){
     echo "Erro com banco de dados:".$e->getMessage();
  	}
  	catch(Exception $e){
    echo "Erro genérico:".$e->getMessage();
  	}

  }
   public function buscarDados()
   {
   	$res = array();
   	$cmd = $this->pdo->query("SELECT * FROM livro ORDER BY autor");
   	$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
   	return $res;
   }
   public function cadastrarLivro($autor, $titulo, $pagina, $editora, $ano)
   {
    $cmd = $this->pdo->prepare("SELECT from id from livro WHERE autor = :a");
    $cmd->bindValue(":a", $autor);
    $cmd->execute();
    if($cmd->rowCount() > 0)
    {
    	return false;
    }else
    {
      $cmd = $this->pdo->prepare("INSERT INTO livro(autor,titulo,pagina,editora,ano) VALUES (:a, :t, :p, :e, :n)");
      $cmd->bindValue(":a", $autor);
      $cmd->bindValue(":t", $titulo);
      $cmd->bindValue(":p", $pagina);
      $cmd->bindValue(":e", $editora);
      $cmd->bindValue(":n", $ano);
      $cmd->execute();
      return true;
    }
   }
   public function excluirLivro($id)
   {
     $cmd = $this->pdo->prepare("DELETE FROM livro WHERE id= :id");
     $cmd->bindValue(":id", $id);
     $cmd->execute();
   }
   public function buscarDadosLivro($id)
   {
   	$res = array();
      $cmd = $this->pdo->prepare("SELECT * FROM livro WHERE id = :id");
      $cmd->bindValue(":id", $id);
      $cmd->execute();
      $res = $cmd->fetch(PDO::FETCH_ASSOC);
      return $res;
   }
   public function atualizarDados($id,$autor,$titulo,$pagina,$editora,$ano)
   {
   	
     $cmd = $this->pdo->prepare("UPDATE livro SET autor = :a, titulo = :t, pagina = :p, editora = :e, ano = :n WHERE id = :id");
     $cmd->bindValue(":a", $autor);
     $cmd->bindValue(":t", $titulo);
     $cmd->bindValue(":p", $pagina);
     $cmd->bindValue(":e", $editora);
     $cmd->bindValue(":n", $ano);
     $cmd->bindValue(":id", $id);
     $cmd->execute();
    
   }
}
?>