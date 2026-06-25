<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'administrador') {
    header('Location: ../login.php');
    exit;
}

require '../conecta.php';

$id = (int) ($_POST['id_produto'] ?? 0);
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome'] ?? ''));
$descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao'] ?? ''));
$preco = (float) ($_POST['preco'] ?? 0);
$imagem = mysqli_real_escape_string($conexao, trim($_POST['imagem'] ?? ''));

if ($nome == '' || $descricao == '' || $preco <= 0) {
    $_SESSION['mensagem'] = ['tipo' => 'erro', 'texto' => 'Preencha os campos corretamente.'];
    header('Location: produto-form.php');
    exit;
}

if ($id > 0) {
    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco=$preco, imagem='$imagem' WHERE id=$id";
    $mensagem = 'Produto atualizado!';
} else {
    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('$nome', '$descricao', $preco, '$imagem')";
    $mensagem = 'Produto cadastrado!';
}

mysqli_query($conexao, $sql);

$_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => $mensagem];
header('Location: index.php');
exit;
