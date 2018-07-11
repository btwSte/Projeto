<?php
  //CONEXÃO COM O BANCO
  require_once('conecta.php');
  Conexao_Database();

  session_start();
  // INICIANDO VARIAVEIS
  $sql="";
  $nome="";
  $telefone="";
  $email="";
  $nomeUser="";
  $senha="";
  $nivel="0";
  $codigo = $_GET['codigo'];

  $sql = "select * from tbl_usuario where codigoUsuario=".$codigo;

  $select = mysql_query($sql);

  if ($rsUser = mysql_fetch_array($select)) {
    $nome = $rsUser["nome"];
    $telefone = $rsUser["telefone"];
    $email = $rsUser["email"];
    $nomeUser = $rsUser["nome_usuario"];
    $senha = $rsUser["senha"];
    $nivel = $rsUser["codigoNivel"];
    $_SESSION['codigoUsuario'] = $rsUser['codigoUsuario'];
  }

  //CHECANDO BOTAO
  if (isset($_POST["btnEnviar"])) {
    $nome = $_POST["txtNome"];
    $telefone = $_POST["txtTelefone"];
    $email = $_POST["txtEmail"];
    $nomeUser = $_POST["txtNomeUser"];
    $senha = $_POST["txtSenha"];
    $nivel = $_POST["nivel"];

    // INSERINDO NO BANCO
      $sql = "update tbl_usuario set
      nome = '$nome', email = '$email', telefone = '$telefone', nome_usuario = '$nomeUser', senha = '$senha', codigoNivel = '$nivel' where codigoUsuario =".$_SESSION['codigoUsuario'];
      if(mysql_query($sql)){
        header('location:user_cadCMS.php');
      }else{
        echo($sql);
      }

  }
  // Executa o script no BD

  // echo ($sql);
  // header('location:novo_usuarioCMS.php');
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_novo_user">
        <form class="frmEditar" action="editar_usuarioCMS.php" method="post">
          <div id="form_div">
            <div id="div_tit">
              <h1>Novo Usuário</h1>
            </div>
            <div id="container_campos">
              <div class="form_itens_ue">
                <div class="text">Nome:</div>
                <div class="text">
                  <input type="text" name="txtNome" maxlength="50" value="<?php echo($nome); ?>">
                </div>
                <div class="text">Email:</div>
                <div class="text">
                  <input type="email" name="txtEmail" maxlength="99" value="<?php echo($email); ?>">
                </div>
                <div class="text">Telefone:</div>
                <div class="text">
                  <input type="text" name="txtTelefone" maxlength="45" value="<?php echo($telefone); ?>">
                </div>
              </div>
              <div class="form_itens_ud">
                <div class="text">Nome de usuário:</div>
                <div class="text">
                  <input  type="text" name="txtNomeUser" maxlength="45" value="<?php echo($nomeUser); ?>">
                </div>
                <div class="text">Senha:</div>
                <div class="text">
                  <input type="password" name="txtSenha" maxlength="45" value="<?php echo($senha); ?>">
                </div>
                <div class="text">Nivel:</div>
                <div class="text">
                  <?php
                    $sql = 'select u.*, n.* from tbl_usuario as u
                    inner join tbl_nivel as n
                    on u.codigoNivel = n.codigoNivel where u.codigoUsuario = '.$codigo.';';
                    $select = mysql_query($sql);

                    $rs = mysql_fetch_array($select);
                    $codNivel = $rs['codigoNivel'];
                    // $_SESSION['codigoUsuario'] = $rs['codigoUsuario'];
                  ?>

                  <select name="nivel">
                    <option value="<?php echo($codNivel);?>"> <?php echo $rs['descricao'] ?> </option>
                    <?php
                    $sql = "select * from tbl_nivel where codigoNivel <> ".$codNivel;
                    $select = mysql_query($sql);
                    while ($rs = mysql_fetch_array($select)) {

                     ?>
                    <option value="<?php echo($rs['codigoNivel']);?>"><?php echo($rs['descricao']); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- BOTAO -->
            <div class="form_itens_btn">
              <input type="submit" name="btnEnviar" value="Enviar">
            </div>
          </div>
        </form>
      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
