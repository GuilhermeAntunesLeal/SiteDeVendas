<?php
  include "conecta.php";
  echo " Inserindo dados...";
  $nome = $_POST["usuario"];
  $s = $_POST["senha"];
  $sql = "insert into usuario(usuario, senha) values('$nome','$s')";

  if (mysqli_query($conexao, $sql)) {
    echo "Cadastrado com sucesso!";
  } else {
    echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
  }
  mysqli_close($conexao);
?>