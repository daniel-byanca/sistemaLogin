
<?php
//---------conexao------------
try{
$pdo = new PDO("mysql:dbname=sistemalogin;host=localhost", "root", ""); 
}
catch(PDOException $e){
echo "Erro com banco de dados!".$e->getMessage();
}catch(Exception $e)
{
echo "Erro com generico!".$e->getMessage();
}
//-------------insert---------
/*$res = $pdo->prepare("INSERT INTO livro(autor,titulo,pagina,editora,ano)VALUES(:a, :t, :p, :e, :n)");
$res->bindValue(":a", "daniel");
$res->bindValue(":t", "seca");
$res->bindValue(":p", "100");
$res->bindValue(":e", "senac");
$res->bindValue(":n", "2000");
$res->execute();*/
//------------delete e update----------
/*$cmd = $pdo->prepare("DELETE FROM livro WHERE id = :id");
$id = 1;
$cmd->bindValue(":id", $id);
$cmd->execute();*/
/*$cmd = $pdo->prepare("UPDATE livro SET autor = :a WHERE id = :id");
$cmd->bindValue(":a", "lucas");
$cmd->bindValue("id", 2);
$cmd->execute();*/
//--------select-------
$cmd = $pdo->prepare("SELECT *FROM livro WHERE id = :id");
$cmd->bindValue("id",2);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);
foreach ($resultado as $key => $value) {
  	echo $key. ": ".$value."<br>";
  }  


?>