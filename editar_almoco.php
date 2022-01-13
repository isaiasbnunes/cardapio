<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $id = $_POST["id"];
        
    $data_cardapio = $_POST["data_cardapio"];
    $item1  = $_POST["item1"];
    $item2  = $_POST["item2"];
    $item3  = $_POST["item3"];
    $item4  = $_POST["item4"];
    $item5 = $_POST["item5"];
    $item6 = $_POST["item6"];
    $obs    = $_POST["obs"];

    if($id != ""){
	    $sql = "UPDATE cardapio SET  data_cardapio = :data_cardapio,
                                     item1 = :item1,
                                     item2 = :item2,
                                     item3 = :item3,
                                     item4 = :item4,
                                     item5 = :item5,
                                     item6 = :item6,
                                     obs = :obs
                                      WHERE id = :id";

		$sql = $pdo->prepare($sql);
		
        $sql->bindValue(":id", $id);
        $sql->bindValue(":data_cardapio", $data_cardapio);
		$sql->bindValue(":item1", $item1);
		$sql->bindValue(":item2", $item2);
        $sql->bindValue(":item3", $item3);
        $sql->bindValue(":item4", $item4);
        $sql->bindValue(":item5", $item5);
        $sql->bindValue(":item6", $item6);
        $sql->bindValue(":obs", $obs);


		if($sql->execute()){
            echo "<script> location.replace('list_cardapio.php'); </script>";
        }else{
            echo "Erro ao tentar editar";
        }
    }
}





?>