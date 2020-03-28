<?php 
class Usu{
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
   	$cmd = $this->pdo->query("SELECT * FROM usu ORDER BY nome");
   	$res = $cmd->fetchAll(PDO::FETCH_ASSOC);
   	return $res;
   }
   public function cadastrarUsu($nome, $cpf, $telefone,$endereco, $cidade, $rg)
   {
    $cmd = $this->pdo->prepare("SELECT from id from usu WHERE nome = :n");
    $cmd->bindValue(":n", $nome);
    $cmd->execute();
    if($cmd->rowCount() > 0)
    {
    	return false;
    }else
    {
      $cmd = $this->pdo->prepare("INSERT INTO usu(nome,cpf,telefone,endereco,cidade,rg) VALUES (:n, :c, :t, :e, :d, :r)");
      $cmd->bindValue(":n", $nome);
      $cmd->bindValue(":c", $cpf);
      $cmd->bindValue(":t", $telefone);
      $cmd->bindValue(":e", $endereco);
      $cmd->bindValue(":d", $cidade);
      $cmd->bindValue(":r", $rg);
      $cmd->execute();
      return true;
    }
   }
   public function excluirUsu($id)
   {
     $cmd = $this->pdo->prepare("DELETE FROM usu WHERE id= :id");
     $cmd->bindValue(":id", $id);
     $cmd->execute();
   }
   public function buscarDadosUsu($id)
   {
   	$res = array();
      $cmd = $this->pdo->prepare("SELECT * FROM usu WHERE id = :id");
      $cmd->bindValue(":id", $id);
      $cmd->execute();
      $res = $cmd->fetch(PDO::FETCH_ASSOC);
      return $res;
   }
   public function atualizarDados($id,$nome,$cpf,$telefone,$endereco,$cidade,$rg)
   {
   	
     $cmd = $this->pdo->prepare("UPDATE usu SET nome = :n, cpf = :c, telefone = :t, endereco = :e, cidade = :d, rg = :r WHERE id = :id");
     $cmd->bindValue(":n", $nome);
     $cmd->bindValue(":c", $cpf);
     $cmd->bindValue(":t", $telefone);
     $cmd->bindValue(":e", $endereco);
     $cmd->bindValue(":d", $cidade);
     $cmd->bindValue(":r", $rg);
     $cmd->bindValue(":id", $id);
     $cmd->execute();
    
   }
}
?>