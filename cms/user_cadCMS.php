<?php
  //CONEXÃO COM O BANCO
  require_once('conecta.php');
  Conexao_Database();

  // INICIANDO VARIAVEIS
  $sql = "";
  $nome = "";
  $telefone = "";
  $email = "";
  $nomeUser = "";
  $senha = "";
  $codigo = "";
  $nivel = "";
  $select = "";

  //Verifica se existe uma variave na URL
  if (isset($_GET['modo'])) {
    # Pega o conteudo da variavel Modo
    $modo = $_GET['modo'];
    # Verifica se a variavel modo = excluir
    if ($modo == 'excluir') {
      # Resgata o código passado na URL
      $codigo = $_GET['codigo'];
      # Deleta no BD o registro
      $sql = "delete from tbl_usuario where codigoUsuario=".$codigo;
      mysql_query($sql);

      #Redireciona a página inicial para apagar o GET da URL
      header('location:user_cadCMS.php');
    }

    # Resgata os dados do banco
    $sql = "select * from tbl_usuario where codigoUsuario=".$codigo;
    #guarda o resultado do banco em uma variavel
    $select = mysql_query($sql);

    if ($rsConsulta = mysql_fetch_array($select)) {
      $nome = $_POST["txtNome"];
      $telefone = $_POST["txtTelefone"];
      $email = $_POST["txtEmail"];
      $nomeUser = $_POST["txtNomeUser"];
      $senha = $_POST["txtSenha"];
      $nivel = $_POST["nivel"];
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Usuarios Cadastrados</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>

    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <form class="" action="user_cadCMS.php" method="post">
      <!-- MAIN -->
      <main id="main_user_cadCMS">
        <div id="segura_user">
          <div id="div_tit">
            <h1>Usuarios Cadastrados</h1>
          </div>
          <div id="div_titulos_user">
            <div class="tit_user">Nome</div>
            <div class="tit_user">Email</div>
            <div class="tit_user">Nome Usuario</div>
            <div class="tit_user">Nivel</div>
          </div>
          <!--Pega as informações do banco -->
          <?php
            $sql = "select * from tbl_usuario order by codigoUsuario desc";
            //usado para pegar o retorno
            $select = mysql_query($sql);
            //Abrindo While
            while ($rsUser = mysql_fetch_array($select)) {
           ?>
          <div id="div_linha_user">
            <div class="item_user_cad"> <?php echo ($rsUser ['nome']); ?> </div>
            <div class="item_user_cad"> <?php echo ($rsUser ['email']); ?> </div>
            <div class="item_user_cad">  <?php echo ($rsUser ['nome_usuario']);?> </div>
            <div class="item_user_cad">  <?php echo ($rsUser ['codigoNivel']); ?> </div>
            <div class="img_user_cad">
              <a href="editar_usuarioCMS.php?modo=editar&codigo=<?php echo ($rsUser['codigoUsuario']) ?>">
              <img src="" alt="Editar" title="Editar">
            </a>
            </div>
            <div class="img_user_cad">
              <a href="detalhes_usuarioCMS.php?modo=detalhes&codigo=<?php echo ($rsUser['codigoUsuario']) ?>">
              <img src="img/Details16.png" alt="Detalhes" title="Detalhes">
            </a>
            </div>
            <div class="img_user_cad">
              <a href="user_cadCMS.php?modo=excluir&codigo=<?php echo ($rsUser['codigoUsuario']) ?>">
              <img src="img/Delete16.png" alt="Excluir" title="Excluir">
              </a>
            </div>
          </div>
          <!--Fechando o While-->
          <?php
            }
           ?>
        </div>
        </form>
      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>

    </body>
</html>
