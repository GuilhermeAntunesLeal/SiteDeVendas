<?php
require 'conecta.php';

$id_compra = $_POST['id_compra'] ?? '';
$id_usuario = $_POST['id_usuario'] ?? '';
$nome_usuario = $_POST['nome_usuario'] ?? '';
$tipo_usuario = $_POST['tipo_usuario'] ?? '';

$sql = "DELETE FROM compras WHERE id = $id_compra";
mysqli_query($conexao, $sql);

header("Location: pagar.php?id_usuario=$id_usuario&nome_usuario=$nome_usuario&tipo_usuario=$tipo_usuario");
exit;
