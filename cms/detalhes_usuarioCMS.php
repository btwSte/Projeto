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
  $codigo = $_GET['codigo'];

  $sql = "select * from tbl_usuario where codigoUsuario=".$codigo;
  $select = mysql_query($sql);

  if ($rsConsulta = mysql_fetch_array($select)) {
    $nome = $rsConsulta["nome"];
    $telefone = $rsConsulta["telefone"];
    $email = $rsConsulta["email"];
    $nomeUser = $rsConsulta["nome_usuario"];
    $senha = $rsConsulta["senha"];
    $nivel = $rsConsulta["codigoNivel"];
  }
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
                  <input type="text" name="txtNome" value="<?php echo($nome);?>">
                </div>
                <div class="text">Email:</div>
                <div class="text">
                  <input type="email" name="txtEmail" value="<?php echo($email);?>">
                </div>
                <div class="text">Telefone:</div>
                <div class="text">
                  <input type="text" name="txtTelefone" value="<?php echo($telefone);?>">
                </div>
              </div>
              <div class="form_itens_ud">
                <div class="text">Nome de usuário:</div>
                <div class="text">
                  <input  type="text" name="txtNomeUser" value="<?php echo($nomeUser);?>">
                </div>
                <div class="text">Senha:</div>
                <div class="text">
                  <input type="password" name="txtSenha" value="<?php echo($senha);?>">
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
          </div>
        </form>
      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
