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
      $codigo = $_GET['codigoSubCategoria'];
      $sql = "delete from tbl_sub_categoria where codigoSubCategoria=".$codigo;
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:novaSubCategoria.php');
      // echo ($sql);
    } elseif ($modo == 'editar') {
      $codigo = $_GET['codigoSubCategoria'];
      $_SESSION['cod_item'] = $codigo;

      $sql = "select * from tbl_sub_categoria where codigoSubCategoria=".$codigo;
      $select = mysql_query($sql);
      // echo $sql;
      $consulta=mysql_fetch_array($select);

      $descricao = $consulta['descricaoSubCategoria'];
      $botao = "Atualizar";
    }
}

  // verifica o clique do botao
  if (isset($_POST['btnEnviar'])) {
    $descricao = $_POST['txtDescricao'];
    $categoria = $_POST['sltcategoria'];
    $operacao = $_POST['btnEnviar'];

    // executa a funcao se as variaveis nao estiverem vazias
    if ($operacao == "Salvar") {
      $sql = "insert into tbl_sub_categoria (codigoCategoria, descricaoSubCategoria) values ('".$categoria."', '".$descricao."')";
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:novaSubCategoria.php');
    } elseif ($operacao == "Atualizar") {
      $sql = "update tbl_sub_categoria set codigoCategoria='".$categoria."', descricaoSubCategoria='".$descricao."' where codigoSubCategoria=".$_SESSION['cod_item'];
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:novaSubCategoria.php');
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
          <h1>Cadastrar Novas Sub Categorias </h1>
        </div>
        <div id="segura_form_sabor">
          <form class="frmNovaSubCategoria" action="novaSubCategoria.php" method="post">
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Sub Categoria:
              </div>
              <div class="item_form_sabor">
                <input type="text" maxlength="20" name="txtDescricao" value="<?php echo($descricao) ?>">
              </div>
            </div>
            <div class="item_form_sabor">
              <select name="sltcategoria">
                <?php
                  if (isset($_GET['codigoCategoria'])){
                    $sql = "select * from tbl_categoria where codigoCategoria = ".$_GET['codigoCategoria'];
                    $select = mysql_query($sql);
                    $rs = mysql_fetch_array($select);
                ?>
                  <option value="<?php echo($rs['codigoCategoria']); ?>">
                    <?php echo($rs['descricaoCategoria']); ?>
                  </option>

                <?php
                  $sql = "select * from tbl_categoria where codigoCategoria <> ".$_GET['codigoCategoria'];
                  $select = mysql_query($sql);

                  while ($rs = mysql_fetch_array($select)) {
                  ?>
                  <option value="<?php echo($rs['codigoCategoria']); ?>">
                   <?php echo($rs['descricaoCategoria']); ?>
                  </option>
                <?php }
                  } else {
                ?>
                  <option value="" selected>Selecione uma categoria</option>

                <?php

                  $sql = "select * from tbl_categoria";
                  $select = mysql_query($sql);

                  while ($rs = mysql_fetch_array($select)) {
                ?>
                 <option value="<?php echo($rs['codigoCategoria']); ?>">
                   <?php echo($rs['descricaoCategoria']); ?>
                  </option>
               <?php }
             } ?>
              </select>
            </div>
            <div class="item_form_sabor">
              <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
            </div>
          </form>
        </div>

        <div id="div_tit">
          <h2>Sub Categorias Cadastradas</h2>
        </div>
        <div id="dados_bd">
          <div id="div_titulos_sabor">
            <div id="tit_sabor">Sub Categorias</div>
          </div>

          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_sub_categoria";
            $select = mysql_query($sql);
            // abertura do while
            while ($rs = mysql_fetch_array($select)) {
           ?>
          <div id="div_linha_sabor">
            <!-- envia os dados do banco para a tela -->
            <div class="item_sabor">
              <?php echo($rs['descricaoSubCategoria']) ;?>
            </div>
            <div class="img_sabor">
              <!-- controla a escolha do usuario -->
              <a href="novaSubCategoria.php?modo=excluir&codigoSubCategoria=<?php echo($rs['codigoSubCategoria']); ?>">
                <img src="#" alt="Excluir" title="Excluir">
              </a>
            </div>
            <div class="img_sabor">
              <a href="novaSubCategoria.php?modo=editar&codigoSubCategoria=<?php echo($rs['codigoSubCategoria']); ?>&codigoCategoria=<?php echo($rs['codigoCategoria']); ?>">
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
