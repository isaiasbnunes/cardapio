<?php

require_once "config.php";


$id = $_GET["id"];

if($_SERVER["REQUEST_METHOD"] == "GET" && $id != "") {
    try {
        $stmt = $pdo->prepare("DELETE FROM cardapio WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<script> location.replace('list_cardapio.php'); </script>";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

?>