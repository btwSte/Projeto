<?php
require_once('cms/conecta.php');
Conexao_Database();

  // INICIANDO VARIAVEIS
  $sql="";
  $nome="";
  $telefone="";
  $celular="";
  $email="";
  $homePage="";
  $sugestao="";
  $facebook="";
  $infProd="";
  $sexo ="";
  $profissao="";

  // CHECANDO BOTAO
  if (isset($_POST["btnEnviar"])) {
    $nome = $_POST["txtNome"];
    $telefone = $_POST["txtTelefone"];
    $celular = $_POST["txtCelular"];
    $email = $_POST["txtEmail"];
    $homePage = $_POST["txtHomePage"];
    $sugestao = $_POST["txtSugestao"];
    $facebook = $_POST["txtFacebook"];
    $infProd = $_POST["txtInfProd"];
    $sexo = $_POST["rdoSexo"];
    $profissao = $_POST["txtProfissao"];

    // INSERINDO NO BANCO
    $sql = "insert into tbl_fale_conosco (nome, telefone, celular, email, homepage, facebook, sugestao, infproduto, sexo, profissao) values ('".$nome."','".$telefone."','".$celular."','".$email."','".$homePage."','".$facebook."','".$sugestao."','".$infProd."','".$sexo."','".$profissao."')";
  }
  // Executa o script no BD
  mysql_query($sql);
  // echo ($sql);
  // header('location:fale_conosco.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Fale Conosco</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">

    <script>
    // MASCARA PARA CAMPO DE TELEFONE
      function mascara()
      {
        var tecla = document.getElementById('tel').value;
        var campo = "";
        // PEGANDO QUANTIDADES DE CAMPOS E APLICANDO A MASCARA
          switch (tecla.length) {
            case 1:
              campo = '(' + tecla;
              document.getElementById('tel').value = campo;
              break;
            case 4:
              campo = tecla  +') ';
              document.getElementById('tel').value = campo;
              break;
            case 10:
              campo = tecla  +'-';
              document.getElementById('tel').value = campo;
              break;
            }
        }
        // MASCARA PARA CAMPO DE CELULAR
        // MESMO PROCEDIMENTO DO TELEFONE
        function mascaraCel() {
          var teclaCel = document.getElementById('cel').value;
          var campoCel = "";

          switch (teclaCel.length) {
            case 1:
              campoCel = '(' + teclaCel;
              document.getElementById('cel').value = campoCel;
              break;
            case 4:
              campoCel = teclaCel + ') ';
              document.getElementById('cel').value = campoCel;
              break;
            case 11:
              campoCel = teclaCel + '-';
              document.getElementById('cel').value = campoCel;
              break;
          }
        }
        // BLOQUEIO DE NUMEROS NO CAMPO NOME
        function validar(caracter, blockType) {
          //Tratamento para verificar por qual navegador esta vindo o evento, caso seja o IE o evento retorna pela propriedade window.event
          if (window.event) {
            /* Transforma em ascii caso a entrada de dados for pelo IE
              var letra = caracter.keyCode;*/
              var letra = caracter.charCode;
          } else {
            /* Transforma em ascii caso a entrada de dados for pelo Chrome e Firefox*/
              var letra = caracter.which;
          }
          /* Tratamento para Bloqueio de caracter e numero */
          if (blockType == 'number'){
            /* Bloqueio de números */
            if (letra >= 48 && letra <= 57) {
              return false;
            }
          } else if (blockType == 'caracter'){
                /*Bloqueio de caracter*/
                if (letra < 48 || letra > 57) {
                  /*Permissão de 'espaço', ' - ' e 'backspace' */
                  if (letra != 45 && letra != 32 && letra != 8 ) {
                    /*document.getElementById('campo').style="background-color:red;";*/
                    return false;
                  }
                }
            }
          }

    </script>

  </head>
  <body>
    <div id="principal">
      <header>
        <div id="cor_nav">
          <!-- MENU E FORM DE LOGIN-->
          <?php include("include/menu.php"); ?>
        </div>
    </header>
      <main id="main_fale_conosco">
          <form class="" action="fale_conosco.php" method="post">
            <div id="form_div">
              <div id="tit">
                <h1>Fale Conosco</h1>
              </div>
              <div class="form_itens">
                <div class="text">Nome*:</div>
                <div class="text">
                  <input required onkeypress="return validar(event, 'number')" type="text" name="txtNome" value=""
                   placeholder="Informe seu nome" pattern="[a-z A-Z ã Ã õ Õ é É í Í ô Ô ó Ó ç Ç]*" title="Digite apenas letras" maxlength="100">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Telefone:</div>
                <div class="text">
                  <input id="tel" onkeypress="return validar(event, 'caracter')" placeholder="Informe seu telefone" type="text" name="txtTelefone" value="" onkeyup="return mascara();" pattern="([0-9]{3}) [0-9]{4}-[0-9]{4}" maxlength="15">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Celular*:</div>
                <div class="text">
                  <input id="cel" required placeholder="Informe seu celular" type="text" name="txtCelular" value="" onkeyup="return mascaraCel();" pattern="([0-9]{3}) [0-9]{5}-[0-9]{4}" maxlength="16">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Email*:</div>
                <div class="text">
                  <input type="email" required placeholder="Informe seu email" name="txtEmail" value="" maxlength="100">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Home Page:</div>
                <div class="text">
                  <input type="url" name="txtHomePage" value="" maxlength="100">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Link no Facebook:</div>
                <div class="text">
                  <input type="url" name="txtFacebook" value="" maxlength="100">
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Sugestão/Criticas:</div>
                <div class="text">
                  <textarea name="txtSugestao" rows="8" cols="40" maxlength="200"></textarea>
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Informações de Produtos:</div>
                <div class="text">
                  <textarea name="txtInfProd" rows="8" cols="40" maxlength="200"> </textarea>
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Sexo*:</div>
                <div class="text">
                  <input type="radio" name="rdoSexo" value="F" checked> Feminino
                  <input type="radio" name="rdoSexo" value="M"> Masculino
                </div>
              </div>
              <div class="form_itens">
                <div class="text">Profissão*:</div>
                <div class="text">
                  <input type="text" required placeholder="Informe sua profissão" name="txtProfissao" value="" maxlength="100">
                </div>
              </div>
              <div class="form_itens">
                <input type="submit" name="btnEnviar" value="Enviar">
              </div>
            </div>
          </form>
        </main>
        <!-- Rodapé -->
        <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
