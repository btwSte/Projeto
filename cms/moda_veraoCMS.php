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
  $upload_dir = "";
  $nome_arq1 = "";
  $nome_arq2 = "";
  $upload_file1 = "";
  $upload_file2 = "";
  $botao = "Salvar";

  if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    if ($modo == 'excluir') {
      $codigo = $_GET['codigo_moda'];
      $sql = "delete from tbl_moda_verao where codigo_moda=".$codigo;
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:moda_veraoCMS.php');
      // echo ($sql);
  } elseif ($modo == 'editar') {


    $codigo = $_GET['codigo_moda'];
    $_SESSION['cod_item'] = $codigo;

    $sql = "select * from tbl_moda_verao where codigo_moda=".$codigo;
    $select = mysql_query($sql);
    // echo $sql;

    $consulta=mysql_fetch_array($select);

    $titulo = $consulta['titulo'];
    $texto1 = $consulta['descricao1'];
    $texto2 = $consulta['descricao2'];
    $upload_file1 = $consulta['imagem1'];
    $upload_file2 = $consulta['imagem2'];
    $botao = "Atualizar";



  }
}

if ($modo == "ativar") {
  $codigo = $_GET['codigo_moda'];
  $sql = "update tbl_moda_verao set status = '0'";
  mysql_query($sql);


  $sql = "update tbl_moda_verao set status = '1' where codigo_moda = ".$codigo;

  mysql_query($sql);
} else if ($modo == "desativar") {
  $codigo = $_GET['codigo_moda'];

  $sql = "update tbl_moda_verao set status = '0' where codigo_moda = ".$codigo;

  mysql_query($sql);
}

  // verifica o clique do botao
  if (isset($_POST['btnEnviar'])) {
    $titulo = $_POST['txtTitulo'];
    $texto1 = $_POST['txtTexto1'];
    $texto2 = $_POST['txtTexto2'];
    $operacao = $_POST['btnEnviar'];

    // recebe funcao que envia as imagens para o banco
    $upload_file1 = Envia_Imagem($_FILES['flefoto1']);
    $upload_file2 = Envia_Imagem($_FILES['flefoto2']);

    // executa a funcao se as variaveis nao estiverem vazias

    if ($operacao == "Salvar") {
      if ($upload_file1 != '' && $upload_file2 != '') {
        $sql = "insert into tbl_moda_verao (titulo, descricao1, descricao2, imagem1, imagem2) values ('".$titulo."', '".$texto1."','".$texto2."','".$upload_file1."', '".$upload_file2."')";
        mysql_query($sql);
      }
    } elseif ($operacao == "Atualizar") {
      // If's criados para nao quebrar a imagem no banco

      // If para atuzalizar apenas textos
      $sql = "update tbl_moda_verao set titulo='".$titulo."', descricao1='".$texto1."', descricao2='".$texto2."' where codigo_moda=".$_SESSION['cod_item'];


      // If para atuzalizar apenas uma imagem
      if ($upload_file1 != '') {
        $sql = "update tbl_moda_verao set imagem1='".$upload_file1."' where codigo_moda=".$_SESSION['cod_item'];
        mysql_query($sql);
        //echo $sql;
      } else if ($upload_file2 != ''){
        $sql = "update tbl_moda_verao set imagem2= '".$upload_file2."' where codigo_moda=".$_SESSION['cod_item'];
        mysql_query($sql);
      }
      mysql_query($sql);
    }



}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - A Moda do Verão</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_moda_veraoCMS">
          <div id="div_tit">
           <h1>A Moda do Verão</h1>
          </div>
          <div class="segura_formulario330">


          <!-- formulario -->
          <form name="frm_moda_verao" action="moda_veraoCMS.php" method="post" enctype="multipart/form-data">
            <div class="segura_item_input">
              <div class="">
                Título:
              </div>
              <div class="">
                <input type="text" maxlength="50" name="txtTitulo" value="<?php echo($titulo) ?>">
              </div>
            </div>
            <div class="segura_item_textarea">
              <div class="">
                Texto 1:
              </div>
              <div class="">
                <textarea rows="8" cols="40" name="txtTexto1" maxlength="3000"><?php echo($texto1) ?></textarea>
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
                <textarea rows="8" cols="40" name="txtTexto2" maxlength="3000" ><?php echo($texto2) ?></textarea>
              </div>
            </div>
            <div class="segura_item_input">
              <div class="">
                Imagem 2:
              </div>
              <div class="">
                <input type="file" name="flefoto2">
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
      				$sql = "select * from tbl_moda_verao";
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
                <a href="moda_veraoCMS.php?modo=excluir&codigo_moda=<?php echo($rs['codigo_moda']); ?>">
                  <img src="#" alt="Excluir" title="Excluir">
                </a>
              </div>
              <div class="edit_moda">
                <a href="moda_veraoCMS.php?modo=editar&codigo_moda=<?php echo($rs['codigo_moda']); ?>">
                  <img src="#" alt="Editar" title=Editar"">
                </a>
              </div>

                <?php
                      if ($rs['status'] == 1){

                 ?>
              <div class="edit_moda">
                <a href="moda_veraoCMS.php?modo=desativar&codigo_moda=<?php echo($rs['codigo_moda']); ?>">
                  <img src="img/ligar.png" alt="Desativar" title="Desativar">
                </a>
              </div>

              <?php
            }else{
               ?>
               <div class="edit_moda">
                 <a href="moda_veraoCMS.php?modo=ativar&codigo_moda=<?php echo($rs['codigo_moda']); ?>">
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
