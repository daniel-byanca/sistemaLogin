<?php
session_start();
unset($_SESSION['id_usuario']);
header("location: index.php"); 
?>
<!--esse codigo serve para quando o usuario sair da pagina e voltar para o index . ele nao conseguir entrar na pagina pela url pois essa sessao nao permite