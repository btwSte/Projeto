<?php
  // Conexão com o banco de dados
  require_once('cms/conecta.php');
  Conexao_Database();
?>

<nav>

  <div class="segura_logo_menum">
    <a href="#">
      <div id="menu_icon">
        <img src="img/menu.png" alt="Menu">
      </div>
    </a>

    <a href="#">
      <div id="logo">
         <img src="img/logo.png" alt="logo">
      </div>
    </a>
  </div>



  <div id="menu">
      <ul>
        <li><a href="index.php"> <h2>Home</h2> </a></li>
        <li><a href="#"> <h2>Destaques</h2> </a>
          <ul>
            <li><a href="suco_mes.php">Suco do mês</a></li>
            <li><a href="promocao.php">Promoções</a></li>
          </ul>
        </li>
        <li><a href="#"> <h2>Curiosidades</h2></a>
          <ul>
            <li><a href="verao.php">A moda do verao</a></li>
            <li><a href="importancia.php">Importancia do suco natural</a></li>
          </ul>
        </li>
        <li><a href="#"> <h2>Empresa</h2></a>
          <ul>
            <li><a href="ambientes.php">Ambientes</a></li>
            <li><a href="fale_conosco.php">Fale conosco</a></li>
          </ul>
        </li>
      </ul>
    </div>
     <div id="divBusca">
       <form class="" action="index.php" method="get">

        <input type="text" name="txtBusca" id="txtBusca" value="" placeholder="Buscar produtos....">
        <input type="submit" name="btnBuscar" value="Buscar"/>
      </form>
    </div>

    <div id="login_link">
      <a href="login.php">LOGIN</a>
    </div>
</nav>
