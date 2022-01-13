<?php
  require_once "config.php";
  session_start();

  date_default_timezone_set('America/Recife'); 

  $data = date("Y-m-d");

  $stmt = $pdo->prepare("SELECT * FROM count ");

  $count = 0;

  if($stmt->execute()) {
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    $count = $rs->visitas;
  } else {
      throw new PDOException("Erro: Não foi possível executar a consulta sql");
  }

  $count = $count +1;
  $sql = "UPDATE count SET visitas=? ";
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$count]);

  $id_cardapio = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cardápio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!--  Arquivo para o modal comentario  -->
  <script type="text/javascript" src="assets/js/comentario.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        
        <span class="d-none d-lg-block">Nutrição - CHCF</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

   



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

       
        <li class="nav-item dropdown pe-3">

          
          
        <span class="d-none d-lg-block">Bem vindo, você é o visitante número:  <?php echo $count ?></span>
         
        
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->



    

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Nutrição</span>
        </a>
      </li><!-- End Dashboard Nav -->
    </ul>
      
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Cardápio</h1>
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
                          <div class="card-icon  d-flex align-items-center justify-content-center">
                            <img src="assets/img/dish1.jpeg" alt="">
                          </div>
                          <div class="ps-3">
                          
                          <h5 class="card-title">Almoço </br><span> <?php echo date('d-m-Y'); ?></span></h5>

                          <ul class="list-group">
                            
                            <?php
                              
                              
                              $consulta = $pdo->query("SELECT * FROM cardapio where data_cardapio = '$data' ;" );

                              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                $id_cardapio = $linha['id'];
                                echo "<li>{$linha['item1']}</li>";
                                if(!empty(trim($linha['item2']))){echo "<li>{$linha['item2']}</li> ";}
                                if(!empty(trim($linha['item3']))){echo "<li>{$linha['item3']}</li> ";}
                                if(!empty(trim($linha['item4']))){echo "<li>{$linha['item4']}</li> ";}
                                if(!empty(trim($linha['item5']))){echo "<li>{$linha['item5']}</li> ";}
                                if(!empty(trim($linha['item6']))){echo "<li>{$linha['item6']}</li> ";}
                                
                                echo " </br>";
                                if(!empty(trim($linha['obs']))){echo "<li>{$linha['obs']}</li> ";}
                                
                              }
                        ?>
                        </ul>
                          </div>
                </div>

              </div>
                          
              <div id="contact">
              <i class="bi bi-chat-left-text" data-bs-toggle="modal" data-bs-target="#feedback-modal">
                Comente
              </i></div>
             
              <?php
                        if(isset($_SESSION['msg'])){
                          echo " <div class='alert alert-success' role='alert'>".  $_SESSION['msg'] . "</div> " ;
                          unset($_SESSION['msg']);
                        }
              ?>
            </div>
          
            
        </div>

      </div>


                <!-- Modal   Comentário  -->
                <div class="modal fade" id="feedback-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                              
                                 <!-- Form    -->
                          <form class="row g-3" action="<?php echo htmlspecialchars("processar_comentario_almoco.php"); ?>" method="post"  >
                              <input type="hidden" value="<?php echo $id_cardapio; ?>" name="id_cardapio" >
                              <div class="col-12">
                                  <label for="nome" class="form-label">Nome</label>
                                  <input type="text" class="form-control" id="nome" name="nome" placeholder="nome">
                              </div>

                              <div class="col-12">
                                  <label for="setor" class="form-label">Setor</label>
                                  <select name="setor" class="form-select" aria-label="Default select example">
                                    
                                      
                                      <?php
                                          $consulta = $pdo->query("SELECT * FROM setor;" );
              
                                          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                              echo " <option value='{$linha['id']}'>{$linha['nome']}</option> ";
                                          }
                                      ?>
                                  </select>
                              </div>

                              <div class="col-12">
                              <div class="form-floating">
                                  <textarea class="form-control" placeholder="comentario" id="comentario" name="comentario" style="height: 100px;"></textarea>
                                  <label for="obs">Comentário</label>
                              </div>
                              </div>
                              <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit" >Salvar</button>
                      </div>
                          </form><!--  Form   -->

                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- Fim modal comentário  -->
                
               

      
      <div class="row">
      
     
          <div class="card">
           
          <div class="card-body">
             
                <div class="d-flex align-items-center">
                          <div class="card-icon  d-flex align-items-center justify-content-center">
                            <img src="assets/img/dish1.jpeg" alt="">
                          </div>
                          <div class="ps-3">
                          
                          <h5 class="card-title">Jantar</br><span> <?php echo date('d-m-Y'); ?></span></h5>

                          <ul class="list-group">
                            
                            <?php
                              
                              $consulta = $pdo->query("SELECT * FROM janta where data_cardapio = '$data' ;" );

                              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                echo "<li>{$linha['item1']}</li>";
                                if(!empty(trim($linha['item2']))){echo "<li>{$linha['item2']}</li> ";}
                                if(!empty(trim($linha['item3']))){echo "<li>{$linha['item3']}</li> ";}
                                if(!empty(trim($linha['item4']))){echo "<li>{$linha['item4']}</li> ";}
                                if(!empty(trim($linha['item5']))){echo "<li>{$linha['item5']}</li> ";}
                                if(!empty(trim($linha['item6']))){echo "<li>{$linha['item6']}</li> ";}
                                
                                echo " </br>";
                                if(!empty(trim($linha['obs']))){echo "<li>{$linha['obs']}</li> ";}
                                
                              }
                        ?>
                        </ul>
                          </div>
                </div>

              </div>


            </div>
          
    
        </div>

      </div>





    </section>

  </main><!-- End #main -->

  

  <?php 
  
     
     include('footer.html'); 
  
  ?>