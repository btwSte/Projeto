<?php
  require_once('conecta.php');
  Conexao_Database();
  @session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Home</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <!-- Segura conteudo-->
     <div id="principal">
       <!-- HEADER -->
       <?php include("include/header.php"); ?>
       <!-- Main  -->
       <main id="homeCMS">
         <div id="alinha_itens">
          <!-- div dos itens da main-->
          <div class="item_main">
            <div class="item_img">
              <img src="img/home-edit.png" alt="Home">
            </div>
            <div class="item_txt">
              Home
            </div>
          </div>
          <!-- div dos itens da main-->
          <div class="item_main">
            <a href="suco_mesCMS.php">
              <div class="item_img">
                <img src="img/suco-mes.png" alt="Suco Do Mês">
              </div>
              <div class="item_txt">
                Suco Do Mês
              </div>
            </a>
          </div>
          <!-- div dos itens da main-->
          <div class="item_main">
            <a href="novaPromocaoCMS.php">
              <div class="item_img">
                <img src="img/promo.png" alt="Promoções">
              </div>
              <div class="item_txt">
                Promoções
              </div>
            </a>
          </div>
          <!-- div dos itens da main-->
          <div class="item_main">
            <a href="moda_veraoCMs.php">
              <div class="item_img">
                <img src="img/summer.png" alt="A Moda Do Verão">
              </div>

              <div class="item_txt">
                A Moda Do Verão
              </div>
            </a>
          </div>
          <!-- div dos itens da main-->
          <div class="item_main">
            <div class="item_img">
              <img src="img/importancia.png" alt="A Importância Do Suco Natural">
            </div>
            <a href="importanciaCMs.php">
              <div class="item_txt">
                A Importância Do Suco Natural
              </div>
            </a>
          </div>
          <!-- div dos itens da main-->
          <div class="item_main">
            <a href="ambienteCMS.php">
              <div class="item_img">
                <img src="img/endereco.png" alt="Endereço">
              </div>
              <div class="item_txt">
                Ambientes
              </div>
            </a>
          </div>
        </div>
       </main>
       <!-- FOOTER -->
       <?php include("include/footer.php"); ?>
     </div>
  </body>
</html>
