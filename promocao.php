<?php
require_once('cms/conecta.php');
Conexao_Database();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Promoções</title>
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
      <main id="main_promocao">
        <div id="conteudo">
          <div id="titulo_promo">
            <h1>Promoções</h1>
          </div>
          <div id="txt_promocao">
            <p>Tá a fim de suco em promoção? Então vem pra Delicia Gelada! Aqui você economiza, sem abrir mão da saúde. São varias opções pra quem curte produtos barato. É só escolher aquele sabor favorito, aproveitar a promoção e curtir o rolê.</p>
          </div>
          <div id="container_produtos_promo">
            <div class="produto_item">
              <div class="img">
                  <img src="img/suco-limao.png" alt="Produto">
              </div>
              <div class="informacao">
                Nome: <br>
                Descrição: <br>
                Preço: <br>
                <div class="detalhe">
                  Detalhes
                </div>
              </div>
            </div>
            <div class="produto_item">
              <div class="img">
                  <img src="img/suco-maca.png" alt="Produto">
              </div>
              <div class="informacao">
                Nome: <br>
                Descrição: <br>
                Preço: <br>
                <div class="detalhe">
                  Detalhes
                </div>
              </div>
            </div>
            <div class="produto_item">
              <div class="img">
                  <img src="img/suco-uva-maca.png" alt="Produto">
              </div>
              <div class="informacao">
                Nome: <br>
                Descrição: <br>
                Preço: <br>
                <div class="detalhe">
                  Detalhes
                </div>
              </div>
            </div>
            <div class="produto_item">
              <div class="img">
                  <img src="img/suco-laranja.png" alt="Produto">
              </div>
              <div class="informacao">
                Nome: <br>
                Descrição: <br>
                Preço: <br>
                <div class="detalhe">
                  Detalhes
                </div>
              </div>
            </div>
            <div class="produto_item">
              <div class="img">
                  <img src="img/suco-limao.png" alt="Produto">
              </div>
              <div class="informacao">
                Nome: <br>
                Descrição: <br>
                Preço: <br>
                <div class="detalhe">
                  Detalhes
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- Rodapé -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
