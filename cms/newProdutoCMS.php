<?php
  // chama funcao que inicia a conexao com o banco
  require_once('conecta.php');
  Conexao_Database();

  session_start();

  // inicia as variaveis
  $sql = "";
  $modo = "";
  $nome = "";
  $preco = "";
  $descricao = "";
  $upload_dir = "";
  $nome_arq = "";
  $upload_file = "";
  $subCategoria = "";
  $botao = "Salvar";

  if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    if ($modo == 'excluir') {
      $codigo = $_GET['codigoProduto'];
      $sql = "delete from tbl_produto where codigoProduto=".$codigo;
      mysql_query($sql);
      #Redireciona a página inicial para apagar o GET da URL
      header('location:newProdutoCMS.php');
      // echo ($sql);

    } elseif ($modo == 'editar') {
      $codigo = $_GET['codigoProduto'];
      $_SESSION['cod_item'] = $codigo;

      $sql = "select * from tbl_produto where codigoProduto=".$codigo;
      $select = mysql_query($sql);
      // echo $sql;


      if ($consulta = mysql_fetch_array($select)) {
        $nome = $consulta['nome'];
        $preco = $consulta['preco'];
        $descricao = $consulta['descricao'];
        $upload_file = $consulta['imagem'];
        $subCategoria = $consulta['codigoSubCategoria'];
        $botao = "Atualizar";
      }


    }
  }

  if ($modo == "ativar") {
    $codigo = $_GET['codigoProduto'];
    $sql = "update tbl_produto set status = '1' where codigoProduto = ".$codigo;
    mysql_query($sql);
  } else if ($modo == "desativar") {
    $codigo = $_GET['codigoProduto'];
    $sql = "update tbl_produto set status = '0' where codigoProduto = ".$codigo;
    mysql_query($sql);
  }



  // verifica o clique do botao
  if (isset($_POST['btnEnviar'])) {
    $nome = $_POST['txtNome'];
    $preco = $_POST['txtPreco'];
    $descricao = $_POST['txtDescricao'];
    $sabor_produto = $_POST["sltsabor1"];
    $subCategoria = $_POST['sltcategoria'];
    $operacao = $_POST['btnEnviar'];
    // recebe funcao que envia as imagens para o banco
    $upload_file = Envia_Imagem($_FILES['flefoto']);

    if ($operacao == "Salvar") {
    // executa a funcao se as variaveis nao estiverem vazias
      if ($upload_file != '') {
        $sql = "INSERT INTO tbl_produto (nome, preco, descricao, imagem, sabor1, codigoSubCategoria) VALUES ('".$nome."', '".$preco."','".$descricao."','".$upload_file."','".$sabor_produto."','".$subCategoria."');";
        mysql_query($sql);

        header('location:newProdutoCMS.php');

      }
    } else if ($operacao == "Atualizar") {
      $codigo = $_GET['codigoProduto'];

      $sql = "UPDATE tbl_produto SET nome='".$nome."', preco='".$preco."', descricao='".$descricao."', sabor1='".$sabor_produto."', codigoSubCategoria='".$subCategoria."' WHERE codigoProduto=".$codigo;

      if ($upload_file != '') {
        $sql = "UPDATE tbl_produto SET imagem = '".$upload_file."' WHERE codigoProduto=".$codigo;
      }
    }

  }


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CMS - Novo Produto</title>
    <link rel="stylesheet" href="css/styleCMS.css">
  </head>
  <body>
    <!-- Segura conteudo-->
    <div id="principal">
     <!-- HEADER -->
     <?php include("include/header.php"); ?>
      <!-- MAIN  -->
     <main id="main_novo_produto">
       <!-- TITULO -->
       <div id="div_tit">
         <h1>Cadastrar Novo Produto</h1>
       </div>

       <div class="segura_form_produto">
         <!-- FORMULARIO -->
         <form class="" action="newProdutoCMS.php" method="post" enctype="multipart/form-data">
           <div class="">
             <div class="item_form_sabor">
               Nome do Produto:
             </div>
             <div class="item_form_sabor">
               <input type="text" maxlength="99" name="txtNome" value="<?php echo($nome) ?>">
             </div>
           </div>
           <div class="">
             <div class="item_form_sabor">
               Preço:
             </div>
             <div class="item_form_sabor">
               <input type="text" name="txtPreco" maxlength="9" value="<?php echo ($preco)?>">
             </div>
           </div>
           <div class="">
             <div class="item_form_sabor">
               Descrição:
             </div>
             <div class="item_form_sabor">
               <textarea rows="8" cols="40" maxlength="254" name="txtDescricao" ><?php echo($descricao) ?></textarea>
             </div>
           </div>
           <div class="">
             <div class="item_form_sabor">
               Imagem do Produto:
             </div>
             <div class="item_form_sabor">
               <input type="file" name="flefoto">
             </div>
           </div>
           <!-- OPTION DE SABOR -->
           <div class="">
             <div class="item_form_sabor">
               Sabor:
             </div>
             <div class="item_form_sabor">
               <select name="sltsabor1">
                 <option value="" selected>Selecione um sabor</option>

                 <?php
                  $sql = "select * from tbl_sabor";
                  $select = mysql_query($sql);

                   while ($rs = mysql_fetch_array($select)) {


                  ?>
                  <option value="<?php echo($rs['codigoSabor']); ?>">
                    <?php echo($rs['descricao']); ?>
                   </option>

                <?php } ?>
               </select>
             </div>
           </div>
           <!-- FIM DO OPTION SABOR -->

           <!--  OPTION DE SUB CATEGORIA -->
           <div class="">
             <div class="item_form_sabor">
               Sub Categoria:
             </div>
             <div class="item_form_sabor">
               <select name="sltcategoria">
                 <option value="" selected>Selecione uma Sub Categoria</option>

                 <?php
                  $sql = "select * from tbl_sub_categoria";
                  $select = mysql_query($sql);

                   while ($rs = mysql_fetch_array($select)) {


                  ?>
                  <option value="<?php echo($rs['codigoSubCategoria']); ?>">
                    <?php echo($rs['descricaoSubCategoria']); ?>
                   </option>

                <?php } ?>
               </select>
             </div>
           </div>
           <!-- FIM DO OPTION DE SUB-CATEGORIA -->
           <div class="item_form_sabor">
             <input type="submit" name="btnEnviar" value="<?php echo ("$botao"); ?>">
           </div>
         </form>
       </div>

       <div id="div_tit">
         <h2>Produtos Cadastrados</h2>
       </div>
       <div id="dados_bd">
         <div id="div_titulos">
           <div class="tit">Nome</div>
           <div class="tit">Preço</div>
           <div class="tit">Descrição</div>
         </div>
         <?php
         // exibe os itens que estao no banco
           $sql = "select * from tbl_produto";
           $select = mysql_query($sql);
           // abertura do while
           while ($rs = mysql_fetch_array($select)) {
          ?>
         <div id="div_linha_prod">
           <!-- envia os dados do banco para a tela -->
           <div class="item_prod"> <?php echo($rs['nome']) ;?> </div>
           <div class="item_prod"> <?php echo($rs['preco'])?> </div>
           <div class="item_prod"> <?php echo($rs['descricao']); ?> </div>

         <div id="segura_edit_prod">
           <div class="edit_prod">
             <!-- controla a escolha do usuario -->
             <a href="newProdutoCMS.php?modo=excluir&codigoProduto=<?php echo($rs['codigoProduto']); ?>">
               <img src="#" alt="Excluir" title="Excluir">
             </a>
           </div>
           <div class="edit_prod">
             <a href="newProdutoCMS.php?modo=editar&codigoProduto=<?php echo($rs['codigoProduto']); ?>">
               <img src="#" alt="Editar" title="Editar">
             </a>
           </div>

             <?php
                   if ($rs['status'] == 1){

              ?>
           <div class="edit_prod">
             <a href="newProdutoCMS.php?modo=desativar&codigoProduto=<?php echo($rs['codigoProduto']); ?>">
               <img src="img/ligar.png" alt="Desativar" title="Desativar">
             </a>
           </div>

           <?php
         }else{
            ?>
            <div class="edit_prod">
              <a href="newProdutoCMS.php?modo=ativar&codigoProduto=<?php echo($rs['codigoProduto']); ?>">
                <img src="img/desligar.png" alt="Ativar" title="Ativar">
              </a>
            </div>

            <?php
          }
             ?>

         </div>

         </div>
         <!-- fechamento do while -->
         <?php } ?>
     </div>
     </main>
     <!-- FOOTER  -->
     <?php include ("include/footer.php"); ?>
    </div>
  </body>
</html>
