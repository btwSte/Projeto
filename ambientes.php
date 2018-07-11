 <?php
 require_once('cms/conecta.php');
 Conexao_Database();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Ambientes</title>
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
      $sql = "select * from tbl_ambiente where status ='1'";
        $select = mysql_query($sql);
        if ($rs = mysql_fetch_array($select)) {
          $titulo = $rs['titulo'];
          $texto1 = $rs['descricao1'];
          $texto2 = $rs['descricao2'];
          $subtitulo = $rs['subtitulo'];
          $logradouro = $rs['logradouro'];
          $numero = $rs['num'];
          $bairro = $rs['bairro'];
          $cidade = $rs['cidade'];
          $estado = $rs['estado'];
          $cep = $rs['cep'];
          $telefone = $rs['telefone'];
        }
       ?>

      <main id="main_ambientes">
        <div id="titulo_amb">
          <h1> <?php echo ($titulo); ?> </h1>
          <h2> <?php  echo($subtitulo); ?> </h2>
        </div>
        <div class="container_ambiente">
          <div class="txt_amb">
            <p> <?php  echo($texto1); ?> </p>
          </div>
          <div class="txt_amb">
            <p> <?php  echo($texto2); ?> </p>
          </div>
          <div class="endereco">
           <?php  echo($logradouro); ?> , nº  <?php  echo($numero); ?> . <br>
           <?php  echo($bairro); ?>  <br>
           <?php  echo($cidade); ?>  -  <?php  echo($estado); ?>   <?php  echo($cep); ?>
          </div>
          <div class="endereco">
            <div class="img_tel">
              <img src="img/tel.png" alt="Telefone">
            </div>
             <div class="txt_tel">
               <?php  echo($telefone); ?>
             </div>
          </div>
        </div>
      </main>
      <!-- Rodapé -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
