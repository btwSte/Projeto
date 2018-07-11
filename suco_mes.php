<?php
require_once('cms/conecta.php');
Conexao_Database();

  $sabor1 = "";
  $sabor2 = "";
  $sabor3 = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Suco do mês</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
  <body>
    <div id="principal">
      <header>
        <div id="cor_nav">
          <!-- MENU E FORM DE LOGIN-->
          <?php include("include/menu.php"); ?>
        </div>
      </header>

      <!-- select no banco -->
      <?php
      $sql = "select * from tbl_suco_mes where status ='1'";
        $select = mysql_query($sql);
        if ($rs = mysql_fetch_array($select)) {
          $texto = $rs['descricao'];
          $titulo = $rs['titulo'];
        }
       ?>

      <main id="main_suco_mes">
        <div class="titulo">
          <h1><?php echo($titulo); ?></h1>
        </div>
        <div id="conteudo_suco_mes">
          <div class="texto_suco_mes">
            <p><?php echo ($texto); ?></p>
          </div>

          <?php
          $sql = "select * from tbl_produto where ativarMes ='1'";
            $select = mysql_query($sql);
            if ($rs = mysql_fetch_array($select)) {
              $nome = $rs['nome'];
              $preco = $rs['preco'];
              $detalhes = $rs['descricao'];
              $sabor1 = $rs['sabor1'];
              $sabor2 = $rs['sabor2'];
              $sabor3 = $rs['sabor3'];
            }
           ?>
          <div id="img_suco">
            <img src="cms/<?php echo ($rs['imagem']); ?>" alt="#">
          </div>
          <div class="texto_suco_mes">
            <p>
              Nome: <?php echo ($nome); ?> <br>
              Preço: <?php echo ($preco); ?> <br>
              Descrição: <?php echo ($detalhes); ?> <br>
              Sabor: <?php echo ($sabor1); ?> //
                      <?php echo($sabor2); ?> //
                      <?php echo($sabor3); ?>

            </p>
          </div>

        </div>
      </main>
      <!-- Rodapé -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
