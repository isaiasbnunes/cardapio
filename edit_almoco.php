<?php

require_once "config.php";
// Inicialize a sessão
session_start();

if ( !isset($_SESSION['username'])){
    header("location:login.php");
}


$id = $_GET["id"];

if($_SERVER["REQUEST_METHOD"] == "GET" && $id != ""  ){

  $stmt = $pdo->prepare("SELECT * FROM cardapio WHERE id = ?");
  $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $item1 = $rs->item1;
            $item2 = $rs->item2;
            $item3 = $rs->item3;
            $item4 = $rs->item4;
            $item5 = $rs->item5;
            $item6 = $rs->item6;
            $item7 = $rs->item7;
            $obs = $rs->obs;
            $data_cardapio = $rs->data_cardapio;

        } else {
            throw new PDOException("Erro: Não foi possível executar a consulta sql");
        }

}
include('head.php'); 
?>



  <main id="main" class="main">

    <div class="pagetitle">
      <h1 class="card-title">Cardápio </h1>

     
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Almoço</h5>

                     <!-- Form    -->
                    <form class="row g-3" action="<?php echo htmlspecialchars("editar_almoco.php"); ?>" method="post">
                        
                        <input type="hidden" value="<?php echo $id; ?>" name="id" >
                        <div class="col-12">
                            <label for="Data" class="form-label">Data</label>
                            <input id="date" value="<?php echo $data_cardapio; ?>" name="data_cardapio" type="date" class="form-control">
                        </div>


                        <div class="col-12">
                            <?php echo (!empty($item1_err)) ? 'is-invalid' : ''; ?> <?php echo ""?>
                            <label for="item1" class="form-label">Item 1</label>
                            <input type="text" value=" <?php echo $item1; ?>" class="form-control" id="item1" name="item1" placeholder="Ex.: Arroz">
                        </div>
                        <div class="col-12">
                            <label for="item2" class="form-label">Item 2</label>
                            <input type="text" value=" <?php echo $item2; ?>" class="form-control" id="item2" name="item2" placeholder="Ex.: Feijão">
                        </div>
                        <div class="col-12">
                            <label for="item3" class="form-label">Item 3</label>
                            <input type="text" value=" <?php echo $item3; ?>" class="form-control" id="item3" name="item3" placeholder="Ex.: Macarrão">
                        </div>

                        <div class="col-12">
                            <label for="item4" class="form-label">Item 4</label>
                            <input type="text" value=" <?php echo $item4; ?>" class="form-control" id="item4" name="item4" placeholder="Ex.: Farofa">
                        </div>


                        <div class="col-12">
                            <label for="item5" class="form-label">Item5</label>
                            <input type="text" value=" <?php echo $item5; ?>" class="form-control" id="item5" name="item5" placeholder="tipo de Salada">
                        </div>

                        <div class="col-12">
                            <label for="item6" class="form-label">Item6</label>
                            <input type="text" value=" <?php echo $item6; ?>" class="form-control" id="item6" name="item6" placeholder="carne">
                        </div>


                        <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="obs" id="obs" name="obs" style="height: 100px;">
                                <?php echo $obs; ?>
                            </textarea>
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
