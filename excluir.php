<?php
require 'conecta.php';

$id_produto = $_GET['id_produto'] ?? '';
$id_usuario = $_GET['id_usuario'] ?? '';
$nome_usuario = $_GET['nome_usuario'] ?? '';
$tipo_usuario = $_GET['tipo_usuario'] ?? '';

$sql = "DELETE FROM produtos WHERE id = $id_produto";
mysqli_query($conexao, $sql);

header("Location: site.php?id_usuario=$id_usuario&nome_usuario=$nome_usuario&tipo_usuario=$tipo_usuario");
exit;
