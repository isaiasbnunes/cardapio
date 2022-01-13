<?php
	
	
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'isaias');
	define('DB_PASSWORD', '341200');
	define('DB_NAME', 'cardapio');
	 
	/* Tentativa de conexão com o banco de dados MySQL */
	try{
	    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" .     DB_NAME, DB_USERNAME, DB_PASSWORD);
	    // Defina o modo de erro PDO para exceção
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
	    die("ERROR: Não foi possível conectar." . $e->getMessage());
	}
?>
