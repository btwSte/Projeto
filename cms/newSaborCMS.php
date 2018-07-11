<?php
  require_once('conecta.php');
  Conexao_Database();

  //iniciar variavel de sessão
  session_start();

  // inicia as variaveis
  $sql = "";
  $descricao = "";
  $botao = "Salvar";
  $modo = "";

  if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    if ($modo == 'excluir') {
      $codigo = $_GET['codigoSabor'];
      $sql = "delete from tbl_sabor where codigoSabor=".$codigo;
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newSaborCMS.php');
      // echo ($sql);
    } elseif ($modo == 'editar') {
      $codigo = $_GET['codigoSabor'];
      $_SESSION['cod_item'] = $codigo;

      $sql = "select * from tbl_sabor where codigoSabor=".$codigo;
      $select = mysql_query($sql);
      // echo $sql;
      $consulta=mysql_fetch_array($select);

      $descricao = $consulta['descricao'];
      $botao = "Atualizar";
    }
}

  // verifica o clique do botao
  if (isset($_POST['btnEnviar'])) {
    $descricao = $_POST['txtDescricao'];
    $operacao = $_POST['btnEnviar'];

    // executa a funcao se as variaveis nao estiverem vazias
    if ($operacao == "Salvar") {
      $sql = "insert into tbl_sabor (descricao) values ('".$descricao."')";
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newSaborCMS.php');

    } elseif ($operacao == "Atualizar") {
      $sql = "update tbl_sabor set descricao='".$descricao."' where codigoSabor=".$_SESSION['cod_item'];
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newSaborCMS.php');

    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Cadastrar Novo Sabor</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>

      <main id="main_novo_sabor">
        <div id="div_tit">
          <h1>Cadastrar Novos Sabores </h1>
        </div>
        <div id="segura_form_sabor">
          <form class="frmNewSabor" action="newSaborCMS.php" method="post">
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Sabor:
              </div>
              <div class="item_form_sabor">
                <input type="text" maxlength="20" name="txtDescricao" value="<?php echo($descricao) ?>">
              </div>
            </div>
            <div class="item_form_sabor">
              <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
            </div>
          </form>
        </div>

        <div id="div_tit">
          <h2>Sabores Cadastrados</h2>
        </div>
        <div id="dados_bd">
          <div id="div_titulos_sabor">
            <div id="tit_sabor">Sabor</div>
          </div>

          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_sabor";
            $select = mysql_query($sql);
            // abertura do while
            while ($rs = mysql_fetch_array($select)) {
           ?>
          <div id="div_linha_sabor">
            <!-- envia os dados do banco para a tela -->
            <div class="item_sabor">
              <?php echo($rs['descricao']) ;?>
            </div>
            <div class="img_sabor">
              <!-- controla a escolha do usuario -->
              <a href="newSaborCMS.php?modo=excluir&codigoSabor=<?php echo($rs['codigoSabor']); ?>">
                <img src="#" alt="Excluir" title="Excluir">
              </a>
            </div>
            <div class="img_sabor">
              <a href="newSaborCMS.php?modo=editar&codigoSabor=<?php echo($rs['codigoSabor']); ?>">
                <img src="#" alt="Editar" title=Editar"">
              </a>
            </div>
          </div>
          <!-- fechamento do while -->
          <?php } ?>
        </div>
      </main>
      <!-- FOOTER -->
      <?php include ("include/footer.php"); ?>
    </div>
  </body>
</html>
