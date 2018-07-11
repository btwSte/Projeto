<?php
  $conexao = mysqli_connect("localhost", "root", "bcd127", "dbdeliciagelada");
  $sql = "select p.*, s.descricao as sabor from tbl_produto p
	inner join tbl_sabor s on p.Sabor1 = s.codigoSabor;";

  $resultado = mysqli_query($conexao, $sql);

  $lstSuco = array();

  if (mysqli_num_rows($resultado) > 0) {
    while ($suco = mysqli_fetch_assoc($resultado)) {
      $lstSuco [] = $suco;
     }
  }

  echo json_encode($lstSuco);

?>
