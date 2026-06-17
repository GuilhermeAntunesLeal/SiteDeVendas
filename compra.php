<?php
  $usuario = $_GET["usuario"];
  $produto = $_GET["produto"];
  $preco = $_GET["preco"];
  
  echo "Bom dia, ".$usuario;
  echo "<br>Você comprou ".$produto.". <br> ";
  echo "Total: ".$preco;
?>