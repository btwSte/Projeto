<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Usuário/Nível</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <div id="principal">
      <!-- HEADER -->
      <?php include("include/header.php"); ?>
      <!-- MAIN -->
      <main id="main_user">
        <div id="div_tit">
         <h1>Adm. Usuário/Nivel</h1>
        </div>
        <div id="alinha_itens_userH">
         <!-- div dos itens da main-->
         <div class="item_user">
          <a href="novo_usuarioCMS.php">
            <div class="item_img">
              <img src="img/add_user.png" alt="Home">
            </div>
            <div class="item_txt">
              Novo Usuário
            </div>
          </a>
         </div>
         <!-- div dos itens da main-->
         <div class="item_user">
           <a href="user_cadCMS.php">
             <div class="item_img">
               <img src="img/edit_user.png" alt="Suco Do Mês">
             </div>
             <div class="item_txt">
               Usuários Cadastrados
             </div>
           </a>
          </div>
          <!-- div dos itens da main-->
          <div class="item_user">
            <a href="newNivelCMS.php">
              <div class="item_img">
                <img src="img/edit_user.png" alt="Suco Do Mês">
              </div>
              <div class="item_txt">
                Cadastrar Nível
              </div>
            </a>
          </div>
       </div>

      </main>
      <!-- FOOTER -->
      <?php include("include/footer.php"); ?>
    </div>
  </body>
</html>
