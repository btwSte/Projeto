<?php
  //CONEXÃO COM O BANCO
  require_once('conecta.php');
  Conexao_Database();
  session_start();

  // INICIANDO VARIAVEIS
  $sql="";
  $desconto = "";
  $botao = "Salvar";
  $sql = "select * from tbl_produto";



//   if (isset($_GET['modo'])) {
//     $modo = $_GET['modo'];
//
//     if ($modo == 'excluir') {
//       $codigo = $_GET['codigoSabor'];
//       $sql = "delete from tbl_sabor where codigoSabor=".$codigo;
//       mysql_query($sql);
//       #Redireciona a página inicial para apagar o GET da URL
//       header('location:newSaborCMS.php');
//       // echo ($sql);
//     } elseif ($modo == 'editar') {
//       $codigo = $_GET['codigoSabor'];
//       $_SESSION['cod_item'] = $codigo;
//
//       $sql = "select * from tbl_sabor where codigoSabor=".$codigo;
//       $select = mysql_query($sql);
//       // echo $sql;
//       $consulta=mysql_fetch_array($select);
//
//       $descricao = $consulta['descricao'];
//       $botao = "Atualizar";
//     }
// }

  // verifica o clique do botao
  if (isset($_POST['btnAdd'])) {
    $codigo = $_GET['codigoProduto'];
    $_SESSION['cod_item'] = $codigo;
    $desconto = $_POST['txtDesconto'];
    $operacao = $_POST['btnAdd'];
    $promocao = $_POST["promocao"];



    // executa a funcao se as variaveis nao estiverem vazias
    if ($operacao == "Salvar") {
      $sql = "insert into tbl_produto (desconto, codigoPromocao) values ('".$desconto."', '".$promocao."') where codigoProduto=".$_SESSION['cod_item'];
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      // header('location:addPromoProdCMS.php')
      echo $sql;

    } elseif ($operacao == "Atualizar") {
      $sql = "update tbl_produto set desconto='".$desconto."', codigoPromocao='".$promocao."' where codigoProduto=".$_SESSION['cod_item'];
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:addPromoProdCMS.php');

    }
  }

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Adicionar Promoção ao Produto</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_novo_user">
        <div id="div_tit">
          <h1> Adicionar Promoção ao Produto </h1>
        </div>

        <div id="segura_form_sabor">
          <form class="frmAddPromoProd" action="addPromoProdCMS.php" method="post">

            <div class="segura_item_input">
              <div class="item_form_sabor">
                Desconto:
              </div>
              <div class="item_form_sabor">
                <input type="text" maxlength="10" name="txtDesconto" value="<?php echo($desconto) ?>">
              </div>
            </div>

            <div class="segura_item_input">
              <div class="item_form_sabor">
                Promoção:
              </div>
              <!-- SELECT DA PROMOCAO -->
              <?php $sql = 'select * from tbl_promocao;';
                $select = mysql_query($sql);
              ?>

              <div class="item_form_sabor">
                <select name="promocao">
                <?php
                  while ($rs = mysql_fetch_array($select)) {
                ?>
                <option value="<?php echo($rs['codigoPromocao']);?>"><?php echo($rs['descricao']); ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="item_form_sabor">
              <input type="submit" name="btnAdd" value="<?php echo ($botao)?>">
            </div>
          </form>
        </div>
      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
