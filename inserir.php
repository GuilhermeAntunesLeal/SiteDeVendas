<?php
require 'conecta.php';

$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$preco = $_POST['preco'] ?? '';
$imagem = $_POST['imagem'] ?? '';
$id_produto = $_POST['id_produto'] ?? '';
$id_usuario = $_POST['id_usuario'] ?? '';
$nome_usuario = $_POST['nome_usuario'] ?? '';
$tipo_usuario = $_POST['tipo_usuario'] ?? '';

if ($id_produto == '') {
    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem)
            VALUES ('$nome', '$descricao', $preco, '$imagem')";
} else {
    $sql = "UPDATE produtos
            SET nome = '$nome', descricao = '$descricao', preco = $preco, imagem = '$imagem'
            WHERE id = $id_produto";
}

mysqli_query($conexao, $sql);

header("Location: site.php?id_usuario=$id_usuario&nome_usuario=$nome_usuario&tipo_usuario=$tipo_usuario");
exit;
