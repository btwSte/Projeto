<?php
  // chama funcao que inicia a conexao com o banco
  require_once('conecta.php');
  Conexao_Database();

  //iniciar variavel de sessão
  session_start();

  $modo = "";


  // inicia as variaveis
  $sql = "";
  $titulo = "";
  $texto1 = "";
  $texto2 = "";
  $texto3 = "";
  $upload_dir = "";
  $nome_arq1 = "";
  $nome_arq2 = "";
  $upload_file1 = "";
  $upload_file2 = "";
  $botao = "Salvar";

  if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    if ($modo == 'excluir') {
      $codigo = $_GET['codigo_importancia'];
      $sql = "delete from tbl_importancia_suco where codigo_importancia=".$codigo;

      mysql_query($sql);

      // Redireciona a página inicial para apagar o GET da URL
      header('location:importanciaCMS.php');
  } elseif ($modo == 'editar') {
    $codigo = $_GET['codigo_importancia'];
    $_SESSION['cod_item'] = $codigo;

    $sql = "select * from tbl_importancia_suco where codigo_importancia=".$codigo;
    $select = mysql_query($sql);
    // echo $sql;

    $consulta=mysql_fetch_array($select);

    $titulo = $consulta['titulo'];
    $texto1 = $consulta['descricao1'];
    $texto2 = $consulta['descricao2'];
    $texto3 = $consulta['descricao3'];
    $upload_file1 = $consulta['imagem1'];
    $upload_file2 = $consulta['imagem2'];
    $botao = "Atualizar";



  }
}

if ($modo == "ativar") {
  $codigo = $_GET['codigo_importancia'];
  $sql = "update tbl_importancia_suco set status = '0'";
  mysql_query($sql);


  $sql = "update tbl_importancia_suco set status = '1' where codigo_importancia = ".$codigo;

  mysql_query($sql);
} else if ($modo == "desativar") {
  $codigo = $_GET['codigo_importancia'];

  $sql = "update tbl_importancia_suco set status = '0' where codigo_importancia = ".$codigo;

  mysql_query($sql);
}

  // verifica o clique do botao
  if (isset($_POST['btnEnviar'])) {
    $titulo = $_POST['txtTitulo'];
    $texto1 = $_POST['txtTexto1'];
    $texto2 = $_POST['txtTexto2'];
    $texto3 = $_POST['txtTexto3'];

    $operacao = $_POST['btnEnviar'];

    // recebe funcao que envia as imagens para o banco
    $upload_file1 = Envia_Imagem($_FILES['flefoto1']);
    $upload_file2 = Envia_Imagem($_FILES['flefoto2']);

    // executa a funcao se as variaveis nao estiverem vazias

    if ($operacao == "Salvar") {
      if ($upload_file1 != '' && $upload_file2 != '') {
        $sql = "insert into tbl_importancia_suco (titulo, descricao1, descricao2, descricao3, imagem1, imagem2) values ('".$titulo."', '".$texto1."','".$texto2."','".$texto3."', '".$upload_file1."', '".$upload_file2."')";

        // Executa comando no bd
        mysql_query($sql);

        header("location:importanciaCMS.php");
      }
    } elseif ($operacao == "Atualizar") {

      // ATUALIZAR TEXTOS
      $sql = "update tbl_importancia_suco set titulo='".$titulo."', descricao1='".$texto1."', descricao2='".$texto2."', descricao3='".$texto3."' where codigo_importancia=".$_SESSION['cod_item'];

      // If para atuzalizar apenas uma imagem
      if ($upload_file1 != '') {
        $sql = "update tbl_importancia_suco set imagem1='".$upload_file1."' where codigo_importancia=".$_SESSION['cod_item'];

        mysql_query($sql);
        //echo $sql;
        header("location:importanciaCMS.php");
      } else if ($upload_file2 != ''){
        $sql = "update tbl_importancia_suco set imagem2= '".$upload_file2."' where codigo_importancia=".$_SESSION['cod_item'];

        mysql_query($sql);
        header("location:importanciaCMS.php");
      }

      mysql_query($sql);

      header("location:importanciaCMS.php");

    }


}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - A Importância do Suco Natural</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_importanciaCMS">
          <div id="div_tit">
           <h1>A Importância do Suco Natural</h1>
          </div>
          <div class="segura_formulario330">
            <!-- formulario -->
            <form name="frm_importancia" action="importanciaCMS.php" method="post" enctype="multipart/form-data">
              <div class="segura_item_input">
                <div class="">
                  Título:
                </div>
                <div class="">
                  <input type="text" name="txtTitulo" value="<?php echo($titulo) ?>">
                </div>
              </div>
              <div class="segura_item_textarea">
                <div class="">
                  Texto 1:
                </div>
                <div class="">
                  <textarea rows="8" maxlength="3000" cols="40" name="txtTexto1" ><?php echo($texto1) ?></textarea>
                </div>
              </div>
              <div class="">
                <div class="item_inp_e">
                  Imagem 1:
                </div>
                <div class="">
                  <input type="file" name="flefoto1">
                </div>
              </div>
              <div class="segura_item_textarea">
                <div class="">
                  Texto 2:
                </div>
                <div class="">
                  <textarea rows="8" maxlength="3000" cols="40" name="txtTexto2" ><?php echo($texto2) ?></textarea>
                </div>
              </div>
              <div class="">
                <div class="">
                  Imagem 2:
                </div>
                <div class="">
                  <input type="file" name="flefoto2">
                </div>
              </div>
              <div class="">
                <div class="">
                  Texto 3:
                </div>
                <div class="">
                  <textarea rows="8" cols="40" maxlength="3000" name="txtTexto3" > <?php echo($texto3) ?> </textarea>
                </div>
              </div>
              <div class="">
                <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
              </div>
            </form>
          </div>
          <div class="segura_div_img">
            <div class="img330">
              <img src="<?php echo($upload_file1)?>" alt="">
            </div>
            <div class="img330">
              <img src="<?php echo($upload_file2)?>" alt="">
            </div>
          </div>
          <div id="dados_bd">
            <div id="div_titulos">
              <div class="tit">Titulo</div>
              <div class="tit">Texto 1</div>
              <div class="tit">Imagem 1</div>
            </div>
            <?php
            // exibe os itens que estao no banco
      				$sql = "select * from tbl_importancia_suco";
      				$select = mysql_query($sql);
              // abertura do while
      				while ($rs = mysql_fetch_array($select)) {
      			 ?>
            <div id="div_linha">
              <!-- envia os dados do banco para a tela -->
              <div class="item_moda"> <?php echo($rs['titulo']) ;?> </div>
              <div class="item_moda"> <?php echo($rs['descricao1'])?> </div>
              <div class="item_moda"> <img src="<?php echo($rs['imagem1']); ?>"> </div>

            <div id="segura_edit">
              <div class="edit_moda">
                <!-- controla a escolha do usuario -->
                <a href="importanciaCMS.php?modo=excluir&codigo_importancia=<?php echo($rs['codigo_importancia']); ?>">
                  <img src="#" alt="Excluir" title="Excluir">
                </a>
              </div>
              <div class="edit_moda">
                <a href="importanciaCMS.php?modo=editar&codigo_importancia=<?php echo($rs['codigo_importancia']); ?>">
                  <img src="#" alt="Editar" title=Editar"">
                </a>
              </div>

                <?php
                      if ($rs['status'] == 1){

                 ?>
              <div class="edit_moda">
                <a href="importanciaCMS.php?modo=desativar&codigo_importancia=<?php echo($rs['codigo_importancia']); ?>">
                  <img src="img/ligar.png" alt="Desativar" title="Desativar">
                </a>
              </div>

              <?php
            }else{
               ?>
               <div class="edit_moda">
                 <a href="importanciaCMS.php?modo=ativar&codigo_importancia=<?php echo($rs['codigo_importancia']); ?>">
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
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
