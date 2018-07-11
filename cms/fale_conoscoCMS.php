<?php
  require_once('conecta.php');
  Conexao_Database();

  // Iniciando variaveis
  $sql = "";
  $nome = "";
  $telefone = "";
  $celular = "";
  $email = "";
  $homePage = "";
  $sugestao = "";
  $facebook = "";
  $infProd = "";
  $sexo = "";
  $profissao = "";
  $codigo = "";
  $select = "";

  //Verifica se existe uma variave na URL
  if (isset($_GET['modo'])) {
    # Pega o conteudo da variavel Modo
    $modo = $_GET['modo'];

    # Verifica se a variavel modo = excluir
    if ($modo == 'excluir') {
      # Resgata o código passado na URL
      $codigo = $_GET['codigo'];
      # Deleta no BD o registro
      $sql = "delete from tbl_fale_conosco where codigo=".$codigo;
      mysql_query($sql);

      #Redireciona a página inicial para apagar o GET da URL
      header('location:fale_conoscoCMS.php');
    }
    # Resgata os dados do banco
    $sql = "select * from tbl_fale_conosco where codigo=".$codigo;
    #guarda o resultado do banco em uma variavel
    $select = mysql_query($sql);

    if ($rsConsulta = mysql_fetch_array($select)) {
      $nome = $_POST["txtNome"];
      $telefone = $_POST["txtTelefone"];
      $celular = $_POST["txtCelular"];
      $email = $_POST["txtEmail"];
      $homePage = $_POST["txtHomePage"];
      $sugestao = $_POST["txtSugestao"];
      $facebook = $_POST["txtFacebook"];
      $infProd = $_POST["txtInfProd"];
      $sexo = $_POST["rdoSexo"];
      $profissao = $_POST["txtProfissao"];
    }
  }
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Fale Conosco</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>

    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <form class="" action="fale_conoscoCMS.php" method="post">
      <!-- MAIN -->
      <main id="fale_conoscoCMS">
        <div id="contato">
            <div id="div_tit">
              <h1>Consulta de Dados</h1>
            </div>
            <div id="div_titulos">
              <div class="tit">Nome</div>
              <div class="tit">Telefone</div>
              <div class="tit">Celular</div>
              <div class="tit">Email</div>
              <div class="tit">Opções</div>
            </div>
            <!--Pega as informações do banco -->
            <?php
              $sql = "select * from tbl_fale_conosco order by codigo desc";
              //usado para pegar o retorno
              $select = mysql_query($sql);

              /* Ambos transformam o resultado do banco em matriz
              * mysql_fetch_array
              * mysql_fetch_assoc
              */

              //Abrindo While
              while ($rsContatos = mysql_fetch_array($select)) {
             ?>
            <div id="div_linha">
              <div class="item_fale_conosco"> <?php echo ($rsContatos ['nome']); ?> </div>
              <div class="item_fale_conosco"> <?php echo ($rsContatos ['telefone']); ?> </div>
              <div class="item_fale_conosco">  <?php echo ($rsContatos ['celular']);?> </div>
              <div class="item_fale_conosco">  <?php echo ($rsContatos ['email']); ?> </div>
              <div class="img_fale_conosco">
                <a href="fc_detalhesCMS.php?modo=detalhes&codigo=<?php echo ($rsContatos['codigo']) ?>">
                <img src="img/Details16.png" alt="Detalhes" title="Detalhes">
              </a>
              </div>
                <!--
                Fazemos um link no botão excluir ou editar para chamar a pagina desejada e passar dois parametros modo e codigo, depois resgatamos essas variaveis para excluir ou editar um registro
              -->
              <div class="img_fale_conosco">
                <a href="fale_conoscoCMS.php?modo=excluir&codigo=<?php echo ($rsContatos['codigo']) ?>">
                <img src="img/Delete16.png" alt="Excluir" title="Excluir">
                </a>
              </div>
            </div>
          <!--Fechando o While-->
          <?php
            }
           ?>
        </div>
        </form>
      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>

    </body>
</html>
