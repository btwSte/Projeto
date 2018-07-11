<?php
  $conexao = mysqli_connect("localhost", "root", "bcd127", "dbdeliciagelada");
  $sql = "select * from tbl_ambiente where codigo_ambiente = 1";
  $resultado = mysqli_query($conexao, $sql);

  $lstTelefone = array();
  $rsTel = mysqli_fetch_assoc($resultado);
  $lstTelefone[] = $rsTel;

  echo json_encode($lstTelefone);
?>
