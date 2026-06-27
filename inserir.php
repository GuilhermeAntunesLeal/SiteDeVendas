<?php
require 'conecta.php';

$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$preco = $_POST['preco'] ?? '';
$imagem = $_POST['imagem'] ?? '';

$sql = "INSERT INTO produtos (nome, descricao, preco, imagem)
        VALUES ('$nome', '$descricao', $preco, '$imagem')";

mysqli_query($conexao, $sql);

header('Location: login.php');
exit;
