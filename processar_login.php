

<?php
session_start();
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if( $_SESSION['captcha'] == $_POST['captcha']){

    // Processando dados do formulário quando o formulário é enviado
    if($_SERVER["REQUEST_METHOD"] == "POST" ){
    
        // Verifique se o nome de usuário está vazio
        if(empty(trim($_POST["username"]))){
            $username_err = "Por favor, insira o nome de usuário.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Verifique se a senha está vazia
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor, insira sua senha.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validar credenciais
        if(empty($username_err) && empty($password_err)){
            // Prepare uma declaração selecionada
            $sql = "SELECT id, username, password, occupation FROM users WHERE username = :username";
            
            if($stmt = $pdo->prepare($sql)){
                // Vincule as variáveis à instrução preparada como parâmetros
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                
                // Definir parâmetros
                $param_username = trim($_POST["username"]);
                
                // Tente executar a declaração preparada
                if($stmt->execute()){
                    // Verifique se o nome de usuário existe, se sim, verifique a senha
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $id = $row["id"];
                            $username = $row["username"];
                            $occupation = $row["occupation"];
                            $hashed_password = $row["password"];
                            if(password_verify($password, $hashed_password)){
                                // A senha está correta, então inicie uma nova sessão
                                
                                
                                // Armazene dados em variáveis de sessão
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username; 
                                $_SESSION["occupation"] = $occupation;                             
                                
                                // Redirecionar o usuário para a página de boas-vindas
                                echo "<script> location.replace('novo_cardapio.php'); </script>";
                                //header("location:novo_cardapio.php");
                            } else{
                                // A senha não é válida, exibe uma mensagem de erro genérica
                                $login_err = "Nome de usuário ou senha inválidos.";
                            }
                        }
                    } else{
                        // O nome de usuário não existe, exibe uma mensagem de erro genérica
                        $login_err = "Nome de usuário ou senha inválidos.";
                    }
                } else{
                    echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                }

                // Fechar declaração
                unset($stmt);
            }
        }
        
        // Fechar conexão
        unset($pdo);
    }
}else{
	$_SESSION['msg'] = "ERRO! Caracteres inválidos.";
	header("Location: login.php");
}



?>