<?php
  //CONEXÃO COM O BANCO
  require_once('conecta.php');
  Conexao_Database();

  // INICIANDO VARIAVEIS
  $sql="";
  $nome="";
  $telefone="";
  $email="";
  $nomeUser="";
  $senha="";
  $nivel="0";


  //CHECANDO BOTAO
  if (isset($_POST["btnEnviar"])) {
    $nome = $_POST["txtNome"];
    $telefone = $_POST["txtTelefone"];
    $email = $_POST["txtEmail"];
    $nomeUser = $_POST["txtNomeUser"];
    $senha = $_POST["txtSenha"];
    $nivel = $_POST["nivel"];

  // INSERINDO NO BANCO
    $sql = "insert into tbl_usuario (nome, email, telefone, nome_usuario, senha, codigoNivel) values ('".$nome."','".$email."','".$telefone."','".$nomeUser."','".$senha."','".$nivel."')";
  }
  // Executa o script no BD
    mysql_query($sql);
  // echo ($sql);
  // header('location:novo_usuarioCMS.php');
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Novo Usuário</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_novo_user">
        <form class="" action="novo_usuarioCMS.php" method="post">
          <div id="form_div">
            <div id="div_tit">
              <h1>Novo Usuário</h1>
            </div>
            <div id="container_campos">
              <div class="form_itens_ue">
                <div class="text">Nome:</div>
                <div class="text">
                  <input type="text" name="txtNome" maxlength="50" value="">
                </div>
                <div class="text">Email:</div>
                <div class="text">
                  <input type="email" name="txtEmail"maxlength="99"  value="">
                </div>
                <div class="text">Telefone:</div>
                <div class="text">
                  <input type="text" name="txtTelefone" maxlength="45" value="">
                </div>
              </div>
              <div class="form_itens_ud">
                <div class="text">Nome de usuário:</div>
                <div class="text">
                  <input  type="text" name="txtNomeUser" maxlength="45" value="">
                </div>
                <div class="text">Senha:</div>
                <div class="text">
                  <input type="password" name="txtSenha" maxlength="45" value="">
                </div>
                <div class="text">Nivel:</div>
                <div class="text">
                  <?php $sql = 'select * from tbl_nivel;';
                  $select = mysql_query($sql);

                    ?>
                  <select name="nivel">
                    <?php while ($rs = mysql_fetch_array($select)) {

                     ?>
                    <option value="<?php echo($rs['codigoNivel']);?>"><?php echo($rs['descricao']); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
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
