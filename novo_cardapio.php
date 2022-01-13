<?php

require_once "config.php";
// Inicialize a sessão
session_start();

if ( !isset($_SESSION['username'])){
    header("location:login.php");
}

include('head.php'); 
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Cardápio</h1>
     
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adicionar Almoço</h5>

                     <!-- Form    -->
                    <form class="row g-3" action="<?php echo htmlspecialchars("processar_novo_cardapio.php"); ?>" method="post">
                        <input type="hidden" name="token" >
                        <div class="col-12">
                            <label for="Data" class="form-label">Data</label>
                            <input id="date" name="data_cardapio" type="date" class="form-control">
                        </div>


                        <div class="col-12">
                            <?php echo (!empty($item1_err)) ? 'is-invalid' : ''; ?> <?php echo ""?>
                            <label for="item1" class="form-label">Item 1</label>
                            <input type="text" class="form-control" id="item1" name="item1" placeholder="Ex.: Arroz">
                        </div>
                        <div class="col-12">
                            <label for="item2" class="form-label">Item 2</label>
                            <input type="text" class="form-control" id="item2" name="item2" placeholder="Ex.: Feijão">
                        </div>
                        <div class="col-12">
                            <label for="item3" class="form-label">Item 3</label>
                            <input type="text" class="form-control" id="item3" name="item3" placeholder="Ex.: Macarrão">
                        </div>

                        <div class="col-12">
                            <label for="item4" class="form-label">Item 4</label>
                            <input type="text" class="form-control" id="item4" name="item4" placeholder="Ex.: Farofa">
                        </div>


                        <div class="col-12">
                            <label for="item5" class="form-label">Item5</label>
                            <input type="text" class="form-control" id="item5" name="item5" placeholder="tipo de Salada">
                        </div>

                        <div class="col-12">
                            <label for="item6" class="form-label">Item6</label>
                            <input type="text" class="form-control" id="item6" name="item6" placeholder="carne">
                        </div>


                        <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="obs" id="obs" name="obs" style="height: 100px;"></textarea>
                            <label for="obs">Observações</label>
                        </div>
                        </div>

                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form><!--  Form   -->

            
            </div>
          </div>

        

      </div>
    </section>

  </main><!-- End #main -->

  <?php include('footer.html'); ?>