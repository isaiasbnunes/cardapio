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
      <h1>Cardápios</h1>
      <nav>
        <ol class="breadcrumb">
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
      
     
       
          <div class="card">
           
          <div class="card-body">
             
                <div class="d-flex align-items-center">

                <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Item1</th>
                    <th scope="col">Item2</th>
                    <th scope="col">Item3</th>
                    <th scope="col">Item4</th>
                    <th scope="col">Item5</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                                 
                              
                                 $consulta = $pdo->query("SELECT * FROM cardapio;" );
   
                                 while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                                  echo "<tr>";
                                    
                                    
                                    echo "<th>{$linha['data_cardapio']}</th>";
                                    echo "<th>{$linha['item1']}</th>";
                                    echo "<th>{$linha['item2']} </th>  ";
                                    echo "<th>{$linha['item3']}</th> ";
                                    echo "<th>{$linha['item4']}</th> ";
                                    echo "<th>{$linha['item5']}</th> ";
                                    echo "<th><a href='edit_almoco.php?id={$linha['id']}'> <i class='bi bi-pencil-square'> </a></th>";
                                    echo "<th><a href='delete_almoco.php?id={$linha['id']}'>  <i class='bi bi-trash-fill'> </a></th>";
                                 }
                        ?>

                </tbody>
              </table>
              


                </div>

              </div>
            </div>
          
    
        </div>

      </div>
          <a href='novo_cardapio.php'>
              <button type="button" class="btn btn-primary">Novo cardapio</button>
          </a>
    </section>

  </main><!-- End #main -->


  <?php include('footer.html'); ?>