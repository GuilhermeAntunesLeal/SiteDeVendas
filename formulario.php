<?php
require 'conecta.php';

$id_usuario = $_GET['id_usuario'] ?? '';
$nome_usuario = $_GET['nome_usuario'] ?? '';
$tipo_usuario = $_GET['tipo_usuario'] ?? '';
$id_produto = $_GET['id_produto'] ?? '';

$nome = '';
$descricao = '';
$preco = '';
$imagem = '';
$titulo = 'Cadastrar produto';

if ($id_produto != '') {
    $sql = "SELECT * FROM produtos WHERE id = $id_produto";
    $resultado = mysqli_query($conexao, $sql);
    $produto = mysqli_fetch_assoc($resultado);

    $nome = $produto['nome'];
    $descricao = $produto['descricao'];
    $preco = $produto['preco'];
    $imagem = $produto['imagem'];
    $titulo = 'Editar produto';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        .caixa {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 25px;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background: #146ef5;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="caixa">
        <h1><?= $titulo ?></h1>

        <button type="button" onclick="history.back()">Voltar</button>

        <form method="post" action="inserir.php">
            <input type="hidden" id="id_usuario" name="id_usuario" value="<?= $id_usuario ?>">
            <input type="hidden" id="nome_usuario" name="nome_usuario" value="<?= $nome_usuario ?>">
            <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="<?= $tipo_usuario ?>">
            <input type="hidden" id="id_produto" name="id_produto" value="<?= $id_produto ?>">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= $nome ?>" required>

            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required><?= $descricao ?></textarea>

            <label for="preco">Preço</label>
            <input type="number" id="preco" name="preco" step="0.01" value="<?= $preco ?>" required>

            <label for="imagem">Imagem</label>
            <input type="text" id="imagem" name="imagem" value="<?= $imagem ?>">

            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>
