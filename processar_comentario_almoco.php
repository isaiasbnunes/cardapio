
<?php

session_start();
require_once "config.php";


 
if(isset($_POST['nome'])  &&  $_SERVER["REQUEST_METHOD"] == "POST" ){
    

    $nome        = $_POST["nome"];
    $setor       = $_POST["setor"];
    $comentario  = $_POST["comentario"];
    $id_cardapio = $_POST["id_cardapio"];
    $rating      = $_POST["rating"];
  
            $data = [
                
                'nome'         => $nome,
                'setor'        => $setor,
                'comentario'   => $comentario,
                'id_cardapio'  => $id_cardapio,
                'rating'       => $rating
                
            ];
            $sql = "INSERT INTO comentario_almoco ( nome, setor, comentario, id_cardapio, rating)
                                  VALUES (:nome, :setor, :comentario, :id_cardapio, :rating)";
            $stmt= $pdo->prepare($sql);
            
            
            if($stmt->execute($data)){
                $_SESSION['msg'] = "Seu comentário foi registrado com sucesso!";
                echo "<script> location.replace('index.php'); </script>";
             //   header('Location:index.php');
               
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
            
    
    }
    // Fechar conexão
    unset($pdo);
    
    




?>