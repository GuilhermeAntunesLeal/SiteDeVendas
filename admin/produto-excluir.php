<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'administrador') {
    header('Location: ../login.php');
    exit;
}

require '../conecta.php';

$id = (int) ($_POST['id_produto'] ?? 0);
mysqli_query($conexao, "DELETE FROM produtos WHERE id = $id");

$_SESSION['mensagem'] = ['tipo' => 'sucesso', 'texto' => 'Produto excluído!'];
header('Location: index.php');
exit;
