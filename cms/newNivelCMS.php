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
      $codigo = $_GET['codigoNivel'];
      $sql = "delete from tbl_nivel where codigoNivel=".$codigo;
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newNivelCMS.php');
      // echo ($sql);
    } elseif ($modo == 'editar') {
      $codigo = $_GET['codigoNivel'];
      $_SESSION['cod_item'] = $codigo;

      $sql = "select * from tbl_nivel where codigoNivel=".$codigo;
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
      $sql = "insert into tbl_nivel (descricao) values ('".$descricao."')";
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newNivelCMS.php');

    } elseif ($operacao == "Atualizar") {
      $sql = "update tbl_nivel set descricao='".$descricao."' where codigoNivel=".$_SESSION['cod_item'];
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newNivelCMS.php');

    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Cadastrar Nível</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>

      <main id="main_novo_sabor">
        <div id="div_tit">
          <h1>Cadastrar Novo Nível </h1>
        </div>
        <div id="segura_form_sabor">
          <form class="frmnewNivel" action="newNivelCMS.php" method="post">
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Nivel:
              </div>
              <div class="item_form_sabor">
                <input type="text" maxlength="30" maxlength="45" name="txtDescricao" value="<?php echo($descricao) ?>">
              </div>
            </div>
            <div class="item_form_sabor">
              <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
            </div>
          </form>
        </div>

        <div id="div_tit">
          <h2>Níveis Cadastrados</h2>
        </div>
        <div id="dados_bd">
          <div id="div_titulos_sabor">
            <div id="tit_sabor">Nível</div>
          </div>

          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_nivel";
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
              <a href="newNivelCMS.php?modo=excluir&codigoNivel=<?php echo($rs['codigoNivel']); ?>">
                <img src="#" alt="Excluir" title="Excluir">
              </a>
            </div>
            <div class="img_sabor">
              <a href="newNivelCMS.php?modo=editar&codigoNivel=<?php echo($rs['codigoNivel']); ?>">
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
