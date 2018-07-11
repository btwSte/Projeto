<?php
require_once('cms/conecta.php');
Conexao_Database();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>A Moda Do Verão</title>
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
      $sql = "select * from tbl_moda_verao where status ='1'";
        $select = mysql_query($sql);
        if ($rs = mysql_fetch_array($select)) {
          $texto1 = $rs['descricao1'];
          $texto2 = $rs['descricao2'];
          $titulo = $rs['titulo'];
        }
       ?>
      <main id="main_verao">
        <div class="titulo">
          <h1> <?php echo ($titulo) ?> </h1>
        </div>

        <div class="text_verao">
        <p> <?php echo ($texto1) ?> </p>
        </div>
        <div class="img_verao">
          <img src="cms/<?php echo ($rs['imagem1']) ?>" alt="#">
        </div>
        <div class="text_verao">
          <p> <?php echo ($texto2) ?> </p>
        </div>
        <div class="img_verao">
          <img src="cms/<?php echo ($rs['imagem2']) ?>" alt="#">
        </div>
      </main>
      <!-- Rodapé -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
