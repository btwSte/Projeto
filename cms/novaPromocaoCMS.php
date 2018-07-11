<?php
require_once('conecta.php');
Conexao_Database();
session_start();

// inicia as variaveis
$sql = "";
$titulo = "";
$descricao = "";
$botao = "Salvar";
$modo = "";
$desconto = "";
if (isset($_GET['modo'])) {
  $modo = $_GET['modo'];

  if ($modo == 'excluir') {
    $codigo = $_GET['codigo'];
    $sql = "delete from tbl_promocao where codigoPromocao=".$codigo;
    mysql_query($sql);
    #Redireciona a página inicial para apagar o GET da URL
    header('location:novaPromocaoCMS.php');
    // echo ($sql);
  } elseif ($modo == 'editar') {
    $codigo = $_GET['codigo'];
    $_SESSION['cod_item'] = $codigo;

    $sql = "select * from tbl_promocao where codigoPromocao=".$codigo;
    $select = mysql_query($sql);
    // echo $sql;
    $consulta=mysql_fetch_array($select);

    $titulo = $consulta['titulo'];
    $descricao = $consulta['descricao'];
    $botao = "Atualizar";
  }
}

// ATIVAR E DESATIVAR PROMOCAO
if ($modo == "ativar") {
  $codigo = $_GET['codigo'];
  mysql_query($sql);

  $sql = "update tbl_promocao set status = '1' where codigoPromocao = ".$codigo;

  mysql_query($sql);
  header('location:novaPromocaoCMS.php');
} else if ($modo == "desativar") {
  $codigo = $_GET['codigo'];
  $sql = "update tbl_promocao set status = '0' where codigoPromocao = ".$codigo;
  mysql_query($sql);
  header('location:novaPromocaoCMS.php');
}


// verifica o clique do botao
if (isset($_POST['btnEnviar'])) {
  $titulo = $_POST['txtTitulo'];
  $descricao = $_POST['txtdescricao'];
  $produto = $_POST['produto'];
  $desconto = $_POST['txtDesconto'];
  $operacao = $_POST['btnEnviar'];

  // executa a funcao se as variaveis nao estiverem vazias
  if ($operacao == "Salvar") {
    $sql = "insert into tbl_promocao (titulo, descricao) values ('".$titulo."', '".$descricao."')";
    $sql2 = "insert into tbl_produto (desconto) values ('".$desconto."')";
    mysql_query($sql);
    mysql_query($sql2);
    #Redireciona a página inicial para apagar o GET da URL
    header('location:novaPromocaoCMS.php');

  } elseif ($operacao == "Atualizar") {
    $sql = "update tbl_promocao set titulo='".$titulo."', descricao='".$descricao."' where codigoPromocao=".$_SESSION['cod_item'];
    mysql_query($sql);
    #Redireciona a página inicial para apagar o GET da URL
    header('location:novaPromocaoCMS.php');

  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Nova Promoção</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <main id="main_promocoes">
        <div id="div_tit">
         <h1>Cadastrar Nova Promoção</h1>
        </div>
        <div class="segura_formulario330">
          <form name="frm_promocao" action="novaPromocaoCMS.php" method="post">
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Titulo:
              </div>
              <div class="item_form_sabor">
                <input type="text" maxlength="45" name="txtTitulo" required value="<?php echo($titulo) ?>">
              </div>
            </div>
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Descricao:
              </div>
              <div class="item_form_sabor">
                <textarea type="text" cols="40" rows="8" maxlength="3000" name="txtdescricao"> <?php echo($descricao) ?> </textarea>
              </div>
            </div>

            <div class="segura_item_input">
              <div class="item_form_sabor">
                Produto:
              </div>
              <div class="item_form_sabor">
                <?php $sql = 'select * from tbl_produto;';
                $select = mysql_query($sql);

                  ?>
                <select name="produto">
                  <?php while ($rs = mysql_fetch_array($select)) {

                   ?>
                  <option value="<?php echo($rs['codigoProduto']);?>"><?php echo($rs['nome']); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="segura_item_input">
              <div class="item_form_sabor">
                Desconto:
              </div>
              <div class="item_form_sabor">
                <input "text" maxlength="30" name="txtDesconto" value="<?php echo($desconto) ?>">
              </div>
            </div>


            <div class="item_form_sabor">
              <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
            </div>
          </form>
        </div>

        <div id="div_tit">
          <h2>Promoções Cadastradas</h2>
        </div>
        <div id="dados_bd_promo">
          <div id="div_titulos">
            <div class="tit">Titulo</div>
            <div class="tit">Descrição</div>
          </div>
          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_promocao";
            $select = mysql_query($sql);
            // abertura do while
            while ($rs = mysql_fetch_array($select)) {
           ?>
          <div id="div_linha_promo">
            <!-- envia os dados do banco para a tela -->
            <div class="item_promo"> <?php echo($rs['titulo']) ;?> </div>
            <div class="item_promo"> <?php echo($rs['descricao']); ?> </div>

          <div id="segura_edit_promo">
            <div class="edit_promo">
              <!-- controla a escolha do usuario -->
              <a href="novaPromocaoCMS.php?modo=excluir&codigo=<?php echo($rs['codigoPromocao']); ?>">
                <img src="#" alt="Excluir" title="Excluir">
              </a>
            </div>
            <div class="edit_promo">
              <a href="novaPromocaoCMS.php?modo=editar&codigo=<?php echo($rs['codigoPromocao']); ?>">
                <img src="#" alt="Editar" title="Editar">
              </a>
            </div>

              <?php
                    if ($rs['status'] == 1){

               ?>
            <div class="edit_promo">
              <a href="novaPromocaoCMS.php?modo=desativar&codigo=<?php echo($rs['codigoPromocao']); ?>">
                <img src="img/ligar.png" alt="Desativar" title="Desativar">
              </a>
            </div>

            <?php
          }else{
             ?>
             <div class="edit_promo">
               <a href="novaPromocaoCMS.php?modo=ativar&codigo=<?php echo($rs['codigoPromocao']); ?>">
                 <img src="img/desligar.png" alt="Ativar" title="Ativar">
               </a>
             </div>

             <?php
           }
              ?>

          </div>

          </div>
          <!-- fechamento do while -->
          <?php } ?>
      </div>
      </main>
      <?php include ("include/footer.php"); ?>
    </div>
  </body>
</html>
