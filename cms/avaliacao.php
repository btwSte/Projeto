<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$conn = mysqli_connect("localhost","root","bcd127", "dbdeliciagelada");

		$idProduto=$_POST["idProduto"];
		$avaliacao=$_POST["avaliacao"];

    $select = "SELECT * FROM tbl_produto WHERE codigoProduto =".$idProduto;

    $search = mysqli_query($conn, $select);

    if($rs = mysqli_fetch_array($search)){

      $avaliacao = $rs['avaliacao'] + 1;

      $sql="UPDATE tbl_produto SET
      avaliacao='$idProduto', pessoas = '$avaliacao'
      WHERE codigo = ".$idProduto;

  		if (mysqli_query($conn, $sql)) {

  			echo json_encode(array(
  					"sucesso" => true ,
  					"mensagem"=> "Inserido com sucesso"));
  		} else {

  			echo json_encode(array(
  					"sucesso" => false ,
  					"mensagem" => mysqli_error($conn)));
  		}
    }

	}else{

		echo json_encode(array(
		"sucesso" => false ,
		"mensagem"=> "Método não suportado"));
	}
?>
