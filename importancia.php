<?php
require_once('cms/conecta.php');
Conexao_Database();
 ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>A importância do suco natural</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
  </head>
  <body>
    <div id="principal">
      <header>
        <div id="cor_nav">
          <!-- MENU E FORM DE LOGIN-->
          <?php include("include/menu.php"); ?>
        </div>
      </header>

      <?php
      $sql = "select * from tbl_importancia_suco where status ='1'";
        $select = mysql_query($sql);
        if ($rs = mysql_fetch_array($select)) {
          $texto1 = $rs['descricao1'];
          $texto2 = $rs['descricao2'];
          $texto3 = $rs['descricao3'];
          $titulo = $rs['titulo'];
        }
       ?>

      <main id="main_importancia">
        <div id="titulo_imp">
          <h1> <?php echo ($titulo) ?> </h1>
        </div>
        <div class="text_importancia">
          <p> <?php echo ($texto1) ?> </p>
        </div>
        <div class="img_importancia">
          <img src="cms/<?php echo ($rs['imagem1']) ?>" alt="#">
        </div>
        <div class="text_importancia">
          <p> <?php echo ($texto2) ?> </p>
        </div>
        <div class="img_importancia">
          <img src="cms/<?php echo ($rs['imagem2']) ?>" alt="#">
        </div>
        <div class="text_importancia">
            <p> <?php echo ($texto3) ?> </p>
        </div>
      </main>
      <!-- Rodapé -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
