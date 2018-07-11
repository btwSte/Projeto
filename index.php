<?php
  require_once('cms/conecta.php');
  Conexao_Database();

  $nomebusca = "";
  $nome = "";
  $descricao = "";
  $preco = "";
  $sql = "";

  if (isset($_GET['subcategoria'])) {
    $sub = $_GET['subcategoria'];
    $sql = "SELECT * FROM tbl_produto WHERE codigoSubCategoria='$sub' AND status = 1;" ;
  } else if (isset($_GET['btnBuscar'])) {
    $nomebusca = $_GET['txtBusca'];
    $sql = "SELECT * FROM tbl_produto WHERE nome LIKE '%$nomebusca%' AND status = 1;";
  } else {
    $sql = "SELECT * FROM tbl_produto WHERE status = 1 ORDER BY rand();";
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <script src="JQuery/jquery.js" type="text/javascript"></script>
    <script src="JQuery/jquery11.js" type="text/javascript"></script>
    <script src="JQuery/Jcycle.js" type="text/javascript"></script>

    <script>
      $(document).ready(function() {

        $(".ver").click(function() {
          $(".modalContainer").slideToggle(2000);
      	//slideToggle
      	//toggle
      	//FadeIn
        });
      });


      	function Modal(idIten){
      		$.ajax({
      			type: "POST",
      			url: "modalProduto.php",
      			data: {id:idIten},
      			success: function(dados){
      				$('.modal').html(dados);
      			}
      		});
      	}
      </script>

    <script type="text/javascript">
    		$(function(){
    			$("#botao_img_slide ul").cycle ({
    				fx:'fade',
    				speed: 2000 ,
    				timeout: 1000 ,
    				prev:'#anterior',
    				next:'#proxima',
    			})
    		})
    </script>

  </head>
  <body>
    <div class="modalContainer">
    	<div class="modal">

    	</div>
    </div>
    <!-- Div para segurar o conteudo -->
    <div id="principal">
      <!-- area do header -->
      <header>
        <div id="cor_nav">
          <!-- MENU E FORM DE LOGIN-->
          <?php include("include/menu.php"); ?>
        </div>
        <!-- Area para o Slider -->
        <div id="slide">
        	<div id="botao_img_slide">
      			<a href="#" id="anterior" >
              <div id="Ant"> &laquo; </div>
            </a>
            <a href="#" id="proxima">
              <div id="Prox">&raquo;</div>
            </a>
        		<ul>
        			<li><a href="suco_mes.php"><img class="imgSlider" alt="Anuncio1" src="img/slide-1.png" /></a></li>
        			<li><a href="importancia.php"><img class="imgSlider" alt="Anuncio2" src="img/slide-2.png" /></a></li>
        			<li><a href="verao.php"><img class="imgSlider" alt="Anuncio3" src="img/slide-3.png" /></a></li>
        		</ul>
        	</div>
        </div>
      </header>
      <!-- Conteudo da pagina -->
      <main id="main_index">
        <div id="rede_social">
          <div class="item_social">
            <a href="#">
              <img src="img/rede_social-1.png" alt="Instagram">
            </a>
          </div>
          <div class="item_social">
            <a href="#">
              <img src="img/rede_social-2.png" alt="Facebook">
            </a>
          </div>
          <div class="item_social">
            <a href="#">
              <img src="img/rede_social-3.png" alt="Twitter">
            </a>
          </div>
        </div>
        <!-- Menu lateral -->
        <div id="segura_conteudo">
          <div id="menu_lateral">
            <ul>
            <?php
            // Select na categoria
              $sqlcategoria = "select * from tbl_categoria;";
              $selectcategoria = mysql_query($sqlcategoria);

              while ($rs =mysql_fetch_array($selectcategoria)) {
                $categoria = $rs['descricaoCategoria'];
             ?>

              <li class="item-lateral">
                <a href="#"><?php echo $categoria; ?></a>
                <ul>
                  <?php
                  // Select na sub categoria
                  $subsql = "select * from tbl_sub_categoria where codigoCategoria=".$rs['codigoCategoria'];
                  $subselect = mysql_query($subsql);
                  while ($subrs =mysql_fetch_array($subselect)) {
                    $subcategoria = $subrs['descricaoSubCategoria'];
                   ?>
                  <li class="subitem-lateral"><a href="index.php?subcategoria=<?php echo $subrs['codigoSubCategoria']; ?>"><?php echo $subcategoria; ?> </a></li>
                  <?php } ?>
                </ul>
              </li>

            <?php } ?>
            </ul>
          </div>
          <!-- Area dos produtos  -->
          <div id="conteudo">
            <div class="produto">
              <?php
                $select = mysql_query($sql);
                if (mysql_num_rows($select) <= 0) {
               ?> <h1> Produto não encontrado</h1>
               <?php
                } else{



                while ($rs = mysql_fetch_array($select)) {
                  $nome = $rs['nome'];
                  $descricao = $rs['descricao'];
                  $preco = $rs['preco'];
                ?>
              <div class="produto_item">
                <div class="img">
                    <img src="cms/<?php echo($rs['imagem']); ?>" alt="Produto">
                </div>
                <div class="informacao">
                  Nome: <?php echo($nome);  ?><br>
                  Descrição: <?php echo($descricao);  ?> <br>
                  Preço: R$ <?php echo($preco); ?><br>
                  <div class="detalhe">
                    <a href="#" class="ver" onclick="Modal(<?php echo($rs['codigoProduto']); ?>)">Detalhes</a>
                  </div>
                </div>
              </div>
              <?php
                }
              } ?>
            </div>
            <div id="container_produtos">

            </div>
          </div>
        </div>
      </main>
      <!-- Rodapé -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
