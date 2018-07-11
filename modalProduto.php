<?php
require_once('cms/conecta.php');
Conexao_Database();
	$id = $_POST['id'];
?>
<html>
	<head>
		<title> </title>
	</head>

	<script>
$(document).ready(function() {

  $(".fechar").click(function() {
    //$(".modalContainer").fadeOut();
	$(".modalContainer").slideToggle(900);
  });
});

	</script>

<body>

	<div>
		<a href="#" class="fechar">Fechar(x)</a>
	</div>
	<div>
		<?php
			// Select do produto clicado
			$sql = "select * from tbl_produto where codigoProduto =".$id;
      $select = mysql_query($sql);
			$rs = mysql_fetch_array($select);
			//Recebe quantidade de clique
			$qtd = $rs['qtdClique'];
			// quantidade +1
			$qtd += 1;
			//Atualiza a quantidade no banco
			$update = "update tbl_produto set qtdClique='$qtd' where codigoProduto=".$id;
			mysql_query($update);
		?>
		<div class="produto_item">
			<div class="img">
					<img src="cms/<?php echo($rs['imagem']); ?>" alt="Produto">
			</div>
			<div class="informacao">
				Nome: <?php echo($rs['nome']);  ?><br>
				Descrição: <?php echo($rs['descricao']);  ?> <br>
				Preço: <?php echo($rs['preco']); ?><br>
			</div>
		</div>
	</div>

</body>
</html>
