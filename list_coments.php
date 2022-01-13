<?php 


require_once "config.php";
session_start();
if ( !isset($_SESSION['username'])  ){
    header("location:login.php");
}


include('head.php'); 
?>


  <main id="main" class="main">

    <div class="pagetitle">
      <div style=" right: 0px; width: 300px; padding: 10px;" >
        
          <input id="date"  name="data_cardapio" type="date" class="form-control">
      </div>
    </div><!-- End Page Title -->
     
       

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Comentários</h5>
             
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comentário</th>
                  </tr>
                </thead>
                <tbody>
                  
                        <?php
                                 
                              
                                 $consulta = $pdo->query("SELECT * FROM comentario_almoco;" );
   
                                 while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                                  echo "<tr>";
                                    echo "<td>{$linha['nome']}</td>";
                                    echo  "<td>" . setor_str($linha['setor']) . "</td>";
                                    echo "<td>{$linha['rating']}</td> ";
                                    echo "<td>{$linha['comentario']}</td> ";
                                }

                                function setor_str($id){
                                    $nome =" ";
                                    $sql = "SELECT * FROM setor WHERE id = :id";
            
                                    if($stmt = $pdo->prepare($sql)){
                                        // Vincule as variáveis à instrução preparada como parâmetros
                                        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
                                        
                                       
                                        // Tente executar a declaração preparada
                                        if($stmt->execute()){
                                            // Verifique se o nome de usuário existe, se sim, verifique a senha
                                            if($stmt->rowCount() == 1){
                                                if($row = $stmt->fetch()){
                                                    $nome = $row["nome"];
                                                }
                                            }
                                        }
                                    }
                                    return $nome;
                                }
                            
                        ?>
                
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>




  </main><!-- End #main -->


  <?php include('footer.html'); ?>