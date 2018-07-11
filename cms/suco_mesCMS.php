<?php
// chama funcao que inicia a conexao com o banco
require_once('conecta.php');
Conexao_Database();

//iniciar variavel de sessão
session_start();

// inicia as variaveis
$sql = "";
$titulo = "";
$texto = "";
$modo = "";
$botao = "Salvar";

if (isset($_GET['modo'])) {
  $modo = $_GET['modo'];
  // caso seja modo excluir
  if ($modo == 'excluir') {
    $codigo = $_GET['codigo'];
    $sql = "delete from tbl_suco_mes where codigoSucoMes=".$codigo;

    mysql_query($sql);

    // Redireciona a página inicial para apagar o GET da URL
    header('location:suco_mesCMS.php');
  } elseif ($modo == 'editar') {
    $codigo = $_GET['codigo'];
    $_SESSION['cod_item'] = $codigo;

    $sql = "select * from tbl_suco_mes where codigoSucoMes=".$codigo;
    $select = mysql_query($sql);
    // echo $sql;

    $consulta=mysql_fetch_array($select);

    $titulo = $consulta['titulo'];
    $texto = $consulta['descricao'];
    $botao = "Atualizar";
    }
}

  if ($modo == "ativar") {
    $codigo = $_GET['codigoSucoMes'];
    $sql = "update tbl_suco_mes set status = '0'";
    mysql_query($sql);


    $sql = "update tbl_suco_mes set status = '1' where codigoSucoMes = ".$codigo;
    mysql_query($sql);

    header('location:suco_mesCMS.php');
  } else if ($modo == "desativar") {
    $codigo = $_GET['codigoSucoMes'];
    $sql = "update tbl_suco_mes set status = '0' where codigoSucoMes = ".$codigo;
    mysql_query($sql);

    header('location:suco_mesCMS.php');
  }

  if ($modo == "ativarProd") {
    $codigo = $_GET['codigoProduto'];
    $sql = "update tbl_produto set ativarMes = '0'";
    mysql_query($sql);

    $sql = "update tbl_produto set ativarMes = '1' where codigoProduto = ".$codigo;
    mysql_query($sql);
    // echo ($sql);
    header('location:suco_mesCMS.php');

  } else if ($modo == "desativarProd") {
    $codigo = $_GET['codigoProduto'];
    $sql = "update tbl_produto set ativarMes = '0' where codigoProduto = ".$codigo;
    mysql_query($sql);

    header('location:suco_mesCMS.php');
    // echo ($sql);
  }

// verifica o clique do botao
if (isset($_POST['btnEnviar'])) {
  $titulo = $_POST['txtTitulo'];
  $texto = $_POST['txtTexto'];
  $operacao = $_POST['btnEnviar'];

  // executa a funcao se as variaveis nao estiverem vazias
  if ($operacao == "Salvar") {
      $sql = "insert into tbl_suco_mes (titulo, descricao) values ('".$titulo."', '".$texto."')";
      // Executa comando no bd
      mysql_query($sql);
      header('location:suco_mesCMS.php');
  } elseif ($operacao == "Atualizar") {
    $sql = "update tbl_suco_mes set titulo='".$titulo."', descricao='".$texto."' where codigoSucoMes=".$_SESSION['cod_item'];
    mysql_query($sql);
    header('location:suco_mesCMS.php');
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Suco do Mês</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <?php include("include/header.php") ?>
      <main id="main_sucoCMS">
        <div id="div_tit">
          <h1>Suco do Mês </h1>
        </div>
        <div id="segura_form_sabor">
          <form class="frm_suco_mes" action="suco_mesCMS.php" method="post">
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Titulo:
              </div>
              <div class="item_form_sabor">
                <input type="text" maxlength="30" name="txtTitulo" value="<?php echo($titulo) ?>">
              </div>
            </div>
            <div class="segura_item_input">
              <div class="item_form_sabor">
                Texto:
              </div>
              <div class="item_form_sabor">
                <textarea name="txtTexto" maxlength="3000"  rows="8" cols="40"><?php echo($texto) ?> </textarea>
              </div>
            </div>
            <div class="item_form_sabor">
              <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
            </div>
          </form>
        </div>

        <div id="div_tit">
          <h2>Sucos do Mês Cadastrados</h2>
        </div>
        <div id="dados_bd">
          <div id="div_titulos_user">
            <div class="tit_user">Titulo</div>
            <div class="tit_user">Texto</div>
          </div>

          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_suco_mes";
            $select = mysql_query($sql);
            // abertura do while
            while ($rsSuco = mysql_fetch_array($select)) {
           ?>

           <div id="div_linha_user">
             <div class="item_user_cad"> <?php echo ($rsSuco ['titulo']); ?> </div>
             <div class="item_user_cad"> <?php echo ($rsSuco ['descricao']); ?> </div>

             <div class="img_user_cad">
               <a href="suco_mesCMS.php?modo=editar&codigo=<?php echo ($rsSuco['codigoSucoMes']) ?>">
               <img src="" alt="Editar" title="Editar">
             </a>
             </div>
             <div class="img_user_cad">
               <a href="suco_mesCMS.php?modo=excluir&codigo=<?php echo ($rsSuco['codigoSucoMes']) ?>">
               <img src="img/Delete16.png" alt="Excluir" title="Excluir">
               </a>
             </div>
           </div>
           <?php  if ($rsSuco['status'] == 1) { ?>
              <div class="edit_moda">
                <a href="suco_mesCMS.php?modo=desativar&codigoSucoMes=<?php echo($rsSuco['codigoSucoMes']); ?>">
                  <img src="img/ligar.png" alt="Desativar" title="Desativar">
                </a>
              </div>

            <?php
              } else {
            ?>
            <div class="edit_moda">
              <a href="suco_mesCMS.php?modo=ativar&codigoSucoMes=<?php echo($rsSuco['codigoSucoMes']); ?>">
                <img src="img/desligar.png" alt="Ativar" title="Ativar">
              </a>
            </div>
            <!-- fecha else -->
          <?php
            }
          ?>
          <!-- fecha if -->
          <?php
            }
          ?>
        </div>

        <div id="div_tit">
          <h2>Produto</h2>
        </div>

        <div id="dados_bd">
          <div id="div_titulos_user">
            <div class="tit_user">Titulo</div>
            <div class="tit_user">Texto</div>
          </div>

          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_produto";
            $select = mysql_query($sql);
            // abertura do while
            while ($rsProduto = mysql_fetch_array($select)) {
           ?>

           <div id="div_linha_user">
             <div class="item_user_cad"> <?php echo ($rsProduto ['nome']); ?> </div>

             <div class="item_suco_mes">
               <img src="<?php echo($rsProduto['imagem'])?>" alt="">
             </div>
           </div>
           <?php  if ($rsProduto['ativarMes'] == 1) { ?>
              <div class="edit_suco_mes">
                <a href="suco_mesCMS.php?modo=desativarProd&codigoProduto=<?php echo($rsProduto['codigoProduto']); ?>">
                  <img src="img/ligar.png" alt="Desativar" title="Desativar">
                </a>
              </div>

            <?php
              } else {
            ?>
            <div class="edit_suco_mes">
              <a href="suco_mesCMS.php?modo=ativarProd&codigoProduto=<?php echo($rsProduto['codigoProduto']); ?>">
                <img src="img/desligar.png" alt="Ativar" title="Ativar">
              </a>
            </div>
            <!-- fecha else -->
          <?php
            }
          ?>
          <!-- fecha if -->
          <?php
            }
          ?>

      </main>
      <?php include("include/footer.php") ?>
    </div>
  </body>
</html>
