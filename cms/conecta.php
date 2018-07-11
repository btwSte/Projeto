<?php
  // funcao para iniciar conexao com o banco
  function Conexao_Database(){
    $conexao=mysql_connect('localhost', 'root', 'bcd127');
    mysql_select_db('dbdeliciagelada');
  }

  // funcao para controlar o upload de imagens
  function Envia_Imagem($obj){
    // Caminho da pasta onde as imagens serão armazenadas
    $upload_dir = "arquivos/";

    // Armazenando o nome e extensão do arquivo que foi selecionado
    $nome_arq = basename($obj['name']);

    if (strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')) {
      $extensao = substr($nome_arq, strpos($nome_arq, "."), 5);
      $prefixo = substr($nome_arq, 0, strpos($nome_arq, "."));
      $nome_arq = md5($prefixo) . $extensao;

      //guardamos o nome e caminho da imagem que sera inserida no banco
      $upload_file = $upload_dir . $nome_arq;

      if (move_uploaded_file($obj['tmp_name'], $upload_file)) {
        // retorna o arquivo para a pagina que chama a funcao
        return $upload_file;
      } else {
        // mensagem de erro
        echo ("Não foi possível enviar o arquivo para o servidor");
      }
    } else {
      // mensagem de erro
      echo "Extensão invalida";
    }
  }
 ?>
