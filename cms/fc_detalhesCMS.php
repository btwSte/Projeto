<?php
  require_once('conecta.php');
  Conexao_Database();

  // Iniciando variaveis
  $sql = "";
  $codigo = $_GET['codigo'];
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
  $masc = "";
  $fem = "";

  // Select no banco
  $sql = "select * from tbl_fale_conosco where codigo=".$codigo;
  #guarda o resultado do banco em uma variavel
  $select = mysql_query($sql);

  if ($rsContatos = mysql_fetch_array($select)) {
    $nome = $rsContatos["nome"];
    $telefone = $rsContatos["telefone"];
    $celular = $rsContatos["celular"];
    $email = $rsContatos["email"];
    $homePage = $rsContatos["homepage"];
    $sugestao = $rsContatos["sugestao"];
    $facebook = $rsContatos["facebook"];
    $infProd = $rsContatos["infproduto"];
    $profissao = $rsContatos["profissao"];
    $sexo = $rsContatos["sexo"];

    if ($sexo == "F") {
      $fem = "checked";
    } else if ($sexo == "M"){
      $masc = "checked";
    }

  }

  if (isset($_POST["btnVoltar"])) {
    header('location:fale_conoscoCMS.php');
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Detalhes</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <form class="" action="fc_detalhesCMS.php" method="post">
      <!-- MAIN -->
      <main id="fale_conoscoCMS">
        <div id="contato">
            <div id="div_tit">
              <h1>Detalhes</h1>
            </div>
          <form class="" action="fale_conosco.php" method="post">
            <div id="form_div">
              <div class="form_itens">
                <div class="text">Nome:</div>
                <div class="text">
                  <input value="<?php echo($nome) ?>">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Telefone:</div>
                <div class="text">
                  <input value="<?php echo($telefone) ?>">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Celular:</div>
                <div class="text">
                  <input value="<?php echo($celular) ?>">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Email:</div>
                <div class="text">
                  <input value="<?php echo($email) ?>">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Home Page:</div>
                <div class="text">
                  <input value="<?php echo($homePage) ?>">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Link no Facebook:</div>
                <div class="text">
                  <input value="<?php echo($facebook) ?>">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Sugestão/Criticas:</div>
                <div class="text">
                  <textarea rows="8" cols="40"> <?php echo($sugestao) ?> </textarea>
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Informações de Produtos:</div>
                <div class="text">
                  <textarea rows="8" cols="40"> <?php echo($infProd) ?> </textarea>
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Sexo:</div>
                <div class="text">
                  <input type="radio" name="rdoSexo" value="F" <?php echo ($fem); ?>> Feminino
                  <input type="radio" name="rdoSexo" value="M" <?php echo ($masc); ?>> Masculino
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Profissão:</div>
                <div class="text">
                  <input value="<?php echo($profissao) ?>">
                </div>
              </div>
            </div>
            <div class="form_itens">
              <input type="submit" name="btnVoltar" value="Voltar">
            </div>
          </form>
        </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
