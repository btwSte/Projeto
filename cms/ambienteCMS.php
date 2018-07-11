<?php
  // INICIAR CONEXAO
  require_once('conecta.php');
  Conexao_Database();

  //iniciar variavel de sessão
  session_start();

  // INICIAR VARIAVEIS
  $modo = "";
  $sql = "";
  $titulo = "";
  $texto1 = "";
  $texto2 = "";
  $subtitulo = "";
  $logradouro = "";
  $numero = "";
  $bairro = "";
  $cidade = "";
  $estado = "";
  $cep = "";
  $telefone = "";
  $botao = "Salvar";

  // CHECANDO MODO NA URL
  if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    // CASO SEJA EXCLUIR
    if ($modo == 'excluir') {
      $codigo = $_GET['codigo_ambiente'];
      // DELETA NO BANCO
      $sql = "delete from tbl_ambiente where codigo_ambiente=".$codigo;
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:ambienteCMS.php');
      // echo ($sql);
  } elseif ($modo == 'editar') {
    $codigo = $_GET['codigo_ambiente'];
    $_SESSION['cod_item'] = $codigo;
    // PEGA OS DADOS
    $sql = "select * from tbl_ambiente where codigo_ambiente=".$codigo;
    $select = mysql_query($sql);
    // echo $sql;

    $consulta=mysql_fetch_array($select);
    // COLOCA OS DADOS NO formulario
    $titulo = $consulta['titulo'];
    $texto1 = $consulta['descricao1'];
    $texto2 = $consulta['descricao2'];
    $subtitulo = $consulta['subtitulo'];
    $logradouro = $consulta['logradouro'];
    $numero = $consulta['num'];
    $bairro = $consulta['bairro'];
    $cidade = $consulta['cidade'];
    $estado = $consulta['estado'];
    $cep = $consulta['cep'];
    $telefone = $consulta['telefone'];
    $botao = "Atualizar";



  }
}

// MODO ATIVAR
if ($modo == "ativar") {
  $codigo = $_GET['codigo_ambiente'];
  // PRIMEIRO DEIXA DESATIVADO
  $sql = "update tbl_ambiente set status = '0'";
  mysql_query($sql);
  // CASO SEJA ATIVAR ELE DA UPDATE DEIXANDO TRUE
  $sql = "update tbl_ambiente set status = '1' where codigo_ambiente = ".$codigo;
  mysql_query($sql);
} else if ($modo == "desativar") {
  $codigo = $_GET['codigo_ambiente'];
  // UPDATE PARA DEIXAR FALSE
  $sql = "update tbl_ambiente set status = '0' where codigo_ambiente = ".$codigo;
  mysql_query($sql);
}

  // verifica o clique do botao
  if (isset($_POST['btnEnviar'])) {
    $titulo = $_POST['txtTitulo'];
    $texto1 = $_POST['txtTexto1'];
    $texto2 = $_POST['txtTexto2'];
    $subtitulo = $_POST['txtSubtitulo'];
    $logradouro = $_POST['txtLogradouro'];
    $numero = $_POST['txtNumero'];
    $bairro = $_POST['txtBairro'];
    $cidade = $_POST['txtCidade'];
    $estado = $_POST['txtEstado'];
    $cep = $_POST['txtCep'];
    $telefone = $_POST['txtTelefone'];
    $operacao = $_POST['btnEnviar'];

    // SE O BOTAO FOR SALVAR, SALVA INFORMAÇÕES NO BANCO
    if ($operacao == "Salvar") {
        $sql = "insert into tbl_ambiente (titulo, descricao1, descricao2, subtitulo, telefone, estado, cep, cidade, bairro, num, logradouro) values ('".$titulo."', '".$texto1."','".$texto2."','".$subtitulo."', '".$telefone."', '".$estado."', '".$cep."', '".$cidade."', '".$bairro."', '".$numero."', '".$logradouro."')";

        mysql_query($sql);
        // Redireciona a página inicial para apagar o GET da URL
        header('location:ambienteCMS.php');

    } elseif ($operacao == "Atualizar") {

      // If para atuzalizar
      $sql = "update tbl_ambiente set titulo='".$titulo."', descricao1='".$texto1."', descricao2='".$texto2."', subtitulo='".$subtitulo."', telefone='".$telefone."', estado='".$estado."', cep='".$cep."', cidade='".$cidade."', bairro='".$bairro."', logradouro='".$logradouro."', num='".$numero."' where codigo_ambiente=".$_SESSION['cod_item'];


      mysql_query($sql);
      // Redireciona a página inicial para apagar o GET da URL
      header('location:ambienteCMS.php');
    }
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Ambientes</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>

      <main id="main_ambientes">
        <div id="div_tit">
         <h1>Nossos Ambientes</h1>
        </div>
        <div class="segura_formulario330">
          <!-- formulario -->
          <form name="frm_ambiente" action="ambienteCMS.php" method="post">
            <div class="segura_item_input">
              <div class="">
                Título:
              </div>
              <div class="">
                <input type="text" maxlength="99" name="txtTitulo" value="<?php echo($titulo) ?>">
              </div>
            </div>
            <div class="segura_item_textarea">
              <div class="">
                Subtítulo:
              </div>
              <div class="">
                <input type="text" name="txtSubtitulo" maxlength="199" value="<?php echo($subtitulo) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                Texto 1:
              </div>
              <div class="">
                <textarea rows="8" cols="40" maxlength="99" name="txtTexto1" > <?php echo($texto1) ?></textarea>
              </div>
            </div>
            <div class="">
              <div class="">
                Texto 2:
              </div>
              <div class="">
                <textarea rows="8" cols="40" maxlength="99" name="txtTexto2" ><?php echo($texto2) ?></textarea>
              </div>
            </div>
            <div class="">
              <div class="">
                Logradouro:
              </div>
              <div class="">
                <input type="text" name="txtLogradouro" maxlength="99" value="<?php echo($logradouro) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                Número:
              </div>
              <div class="">
                <input type="text" name="txtNumero" maxlength="10" value="<?php echo($numero) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                Bairro:
              </div>
              <div class="">
                <input type="text" name="txtBairro" maxlength="99" value="<?php echo($bairro) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                Cidade:
              </div>
              <div class="">
                <input type="text" name="txtCidade" maxlength="100" value="<?php echo($cidade) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                CEP:
              </div>
              <div class="">
                <input type="text" name="txtCep" maxlength="15" value="<?php echo($cep) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                Estado:
              </div>
              <div class="">
                <input type="text" name="txtEstado" maxlength="99" value="<?php echo($estado) ?>">
              </div>
            </div>
            <div class="">
              <div class="">
                Telefone:
              </div>
              <div class="">
                <input type="text" name="txtTelefone" maxlength="14" value="<?php echo($telefone) ?>">
              </div>
            </div>
            <div class="">
              <input type="submit" name="btnEnviar" value="<?php echo ($botao)?>">
            </div>
          </form>
          </form>
        </div>

        <div id="dados_bd">
          <div id="div_titulos">
            <div class="tit">Titulo</div>
            <div class="tit">Texto 1</div>
            <div class="tit">Imagem 1</div>
          </div>
          <?php
          // exibe os itens que estao no banco
            $sql = "select * from tbl_ambiente";
            $select = mysql_query($sql);
            // abertura do while
            while ($rs = mysql_fetch_array($select)) {
           ?>
          <div id="div_linha">
            <!-- envia os dados do banco para a tela -->
            <div class="item_moda"> <?php echo($rs['titulo']) ;?> </div>
            <div class="item_moda"> <?php echo($rs['subtitulo'])?> </div>
            <div class="item_moda"> <?php echo($rs['descricao1']); ?> </div>

          <div id="segura_edit">
            <div class="edit_moda">
              <!-- controla a escolha do usuario -->
              <a href="ambienteCMS.php?modo=excluir&codigo_ambiente=<?php echo($rs['codigo_ambiente']); ?>">
                <img src="#" alt="Excluir" title="Excluir">
              </a>
            </div>
            <div class="edit_moda">
              <a href="ambienteCMS.php?modo=editar&codigo_ambiente=<?php echo($rs['codigo_ambiente']); ?>">
                <img src="#" alt="Editar" title=Editar"">
              </a>
            </div>
              <!-- ABRE O IF -->
              <?php
                  // IF PARA DESATIVAR O CONTEUDO
                    if ($rs['status'] == 1){

               ?>
            <div class="edit_moda">
              <a href="ambienteCMS.php?modo=desativar&codigo_ambiente=<?php echo($rs['codigo_ambiente']); ?>">
                <img src="img/ligar.png" alt="Desativar" title="Desativar">
              </a>
            </div>

            <?php
          // FECHA O IF E ABRE ELSE
          // ELSE PARA ATIVAR CONTEUDO
          }else{
             ?>

             <div class="edit_moda">
               <a href="ambienteCMS.php?modo=ativar&codigo_ambiente=<?php echo($rs['codigo_ambiente']); ?>">
                 <img src="img/desligar.png" alt="Ativar" title="Ativar">
               </a>
             </div>

            <!-- FECHA O ELSE -->
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
      <?php include ("include/footer.php"); ?>
    </div>
  </body>
</html>
