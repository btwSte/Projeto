<?php
  // Conexão com o banco de dados
  require_once('cms/conecta.php');
  Conexao_Database();

  //iniciar variavel de sessão
  session_start();

  // INICIANDO VARIAVEIS
  $sql = "";
  $login = "";
  $senha = "";

  if (isset($_POST["enviar"])) {
    // Recupera o login
    $login = $_POST['txtNome'];
    $senha = $_POST["pwdSenha"];

    $sql = "select * from tbl_usuario where nome_usuario = '".$login."' and senha = '".$senha."';";
    $select = mysql_query($sql);


    if ($rs = mysql_fetch_array($select)) {
      $_SESSION['nome'] = $rs['nome'];
      $_SESSION['codigoNivel'] = $rs ['codigoNivel'];
        if ($_SESSION['codigoNivel'] == 3) {
          header ('location:cms/produtosCMS.php');
        } else {
          header('location:cms/homeCMS.php');
        }

    } else {
      echo ("<script>alert('Informe um login e senha válidos!');</script>");
    }
  }

  if (isset($_POST["voltar"])) {
    header('location:index.php');
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
  </head>
  <body>
    <!-- Formulário de Login -->
    <form action="login.php" method="post">
      <!-- Div que segura os itens do formulario -->
      <div id="segurar_form">
        <div class="texto_login">
          Nome de usuário:
        </div>
        <div class="form_usuario">
          <input type="text" name="txtNome" placeholder="Ex: joao">
        </div>
        <div class="texto_login">
          Senha:
        </div>
        <div class="form_usuario">
          <input type="password" name="pwdSenha" value="" placeholder="Informe sua senha">
        </div>
        <div class="texto_login">

        </div>
        <div class="btn_login">
          <input type="submit" name="enviar" value="Login">
          <input type="submit" name="voltar" value="Voltar">
        </div>
      </div>
    </form>
  </body>
</html>
