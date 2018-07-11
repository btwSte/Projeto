<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Produtos</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_produto">
        <div id="div_tit">
         <h1>Adm. Produtos</h1>
        </div>
        <div id="alinha_itens_produtos">
          <div class="item_user">
            <a href="newProdutoCMS.php">
              <div class="item_txt">
                Produtos
              </div>
            </a>
          </div>
          <a href="newSaborCMS.php">
            <div class="item_user">
              <div class="item_txt">
                Sabores
              </div>
            </div>
          </a>
          <a href="novaCategoria.php">
            <div class="item_user">
              <div class="item_txt">
                Categoria
              </div>
            </div>
          </a>
          <a href="novaSubCategoria.php">
            <div class="item_user">
              <div class="item_txt">
                Sub Categoria
              </div>
            </div>
          </a>
        </div>

      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
