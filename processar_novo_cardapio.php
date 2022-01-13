
<?php


require_once "config.php";


    $data_cardapio = "";
    $item1  = " ";
    $item2  = " ";
    $item3  = " ";
    $item4  = " ";
    $item5 = " ";
    $item6 = " ";

    $obs  = " ";

 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token']) ){
    

        
    $data_cardapio = $_POST["data_cardapio"];
    $item1  = $_POST["item1"];
    $item2  = $_POST["item2"];
    $item3  = $_POST["item3"];
    $item4  = $_POST["item4"];
    $item5 = $_POST["item5"];
    $item6 = $_POST["item6"];
    $obs    = $_POST["obs"];


  
       
            $data = [
                'data_cardapio' => $data_cardapio,
                'item1'         => $item1,
                'item2'         => $item2,
                'item3'         => $item3,
                'item4'         => $item4,
                'item5'        => $item5,
                'item6'        => $item6,
                'obs'           => $obs,
            ];
            $sql = "INSERT INTO cardapio (data_cardapio, item1, item2, item3, item4, item5, item6, obs)
                                  VALUES (:data_cardapio, :item1, :item2, :item3, :item4, :item5, :item6, :obs)";
            $stmt= $pdo->prepare($sql);
            
            
            if($stmt->execute($data)){
                
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