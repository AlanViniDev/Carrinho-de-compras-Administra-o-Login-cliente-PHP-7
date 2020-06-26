<?php
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DBNAME', 'loja');
	define('PORT', '');
	
	try {
    $conexao = new pdo('mysql:host=' . HOST . ';port=' . PORT . ';dbname=' . DBNAME, USER, PASS);
	echo "Conexão com banco de dados realizada com sucesso.";
	}
	catch (PDOException $e) {
		echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $e->getMessage();
	}
?>