<?php
require_once('conecta.php');
Conexao_Database();

@session_start();
$conteudo = "#";
$faleconosco = "#";
$produtos = "#";
$usuarios = "#";


if ($_SESSION['codigoNivel'] == 3) {
  $produtos = "produtosCMS.php";
} else if ($_SESSION['codigoNivel'] == 2){
  $conteudo = "HomeCMS.php";
  $faleconosco = "fale_conoscoCMS.php";
  $usuarios = "usuarioCMS.php";
} else if ($_SESSION['codigoNivel'] == 1) {
  $conteudo = "HomeCMS.php";
  $faleconosco = "fale_conoscoCMS.php";
  $usuarios = "usuarioCMS.php";
  $produtos = "produtosCMS.php";
}


?>

<header>
  <!-- Segura titulo e logo -->
  <div id="segura_titulo_logo">
    <!-- div do titulo-->
    <div id="titulo">
     CMS - Sistema de Gerenciamento do Site
    </div>
    <!-- div logo -->
    <div id="logo">
      <img src="#" alt="Logo">
    </div>
  </div>
  <!-- AREA DO MENU -->
  <nav>
    <!-- div que segura o menu -->
    <div id="menu_nav">
      <!-- item do menu -->
       <div class="item_menu">
         <a href="<?php echo($conteudo) ?>">
           <div class="img_menu">
             <img src="img/content.png" alt="Icon teste">
           </div>
           <div class="txt_menu">
             Adm. Conteúdo
           </div>
         </a>
       </div>
       <!-- item do menu -->
       <div class="item_menu">
         <a href="<?php echo($faleconosco) ?>">
           <div class="img_menu">
             <img src="img/tel.png" alt="Icon teste">
           </div>
           <div class="txt_menu">
             Adm. Fale Conosco
           </div>
         </a>
       </div>
       <!-- item do menu -->
       <div class="item_menu">
         <a href="<?php echo($produtos) ?>">
           <div class="img_menu">
             <img src="img/produto.png" alt="Icon teste">
           </div>
           <div class="txt_menu">
             Adm. Produtos
           </div>
         </a>
       </div>
       <!-- item do menu -->
       <div class="item_menu">
         <a href="<?php echo($usuarios) ?>">
           <div class="img_menu">
             <img src="img/user.png" alt="Icon teste">
           </div>
           <div class="txt_menu">
             Adm. Usuários
           </div>
          </a>
        </div>
    </div>
    <!-- area com nome do usuario e logout-->
    <div id="texto_nav">
      <div id="txt_user">
        BEM VINDO: <?php  echo ($_SESSION['nome']);?>
      </div>
      <div id="txt_sair">
        <form class="" action="../index.php" method="post">
          <input type="submit" name="btnLogout" value="Logout">
        </form>
      </div>
    </div>
  </nav>
</header>
