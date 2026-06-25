<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['usuario']['tipo'] == 'administrador' || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: loja.php');
    exit;
}

require 'conecta.php';

$produtoId = (int) ($_POST['id_produto'] ?? 0);
$usuarioId = (int) $_SESSION['usuario']['id'];

$resultado = mysqli_query($conexao, "SELECT preco FROM produtos WHERE id = $produtoId");
$produto = mysqli_fetch_assoc($resultado);

if (!$produto) {
    $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Produto não encontrado.'];
    header('Location: loja.php');
    exit;
}

$preco = $produto['preco'];
$sql = "INSERT INTO compras (usuario_id, produto_id, quantidade, preco_unitario)
        VALUES ($usuarioId, $produtoId, 1, $preco)";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Compra realizada com sucesso!'];
} else {
    $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Erro ao realizar a compra.'];
}

header('Location: minhas-compras.php');
exit;
