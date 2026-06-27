<?php
require 'conecta.php';

$id_usuario = $_POST['id_usuario'] ?? '';
$nome_usuario = $_POST['nome_usuario'] ?? '';
$tipo_usuario = $_POST['tipo_usuario'] ?? '';
$id_produto = $_POST['id_produto'] ?? '';

$sql_produto = "SELECT preco FROM produtos WHERE id = $id_produto";
$resultado = mysqli_query($conexao, $sql_produto);
$produto = mysqli_fetch_assoc($resultado);
$preco = $produto['preco'];

$sql = "INSERT INTO compras (usuario_id, produto_id, quantidade, preco_unitario)
        VALUES ($id_usuario, $id_produto, 1, $preco)";

mysqli_query($conexao, $sql);

header("Location: pagar.php?id_usuario=$id_usuario&nome_usuario=$nome_usuario&tipo_usuario=$tipo_usuario");
exit;
