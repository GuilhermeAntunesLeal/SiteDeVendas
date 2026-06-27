<?php
require 'conecta.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo)
            VALUES ('$nome', '$email', '$senha', 'usuario')";

    mysqli_query($conexao, $sql);
    $mensagem = 'Conta criada!';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar conta</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #07142f, #1477ef);
        }

        .caixa {
            width: 350px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background: #146ef5;
            color: white;
            border: none;
            font-weight: bold;
        }

        .mensagem {
            color: green;
        }

        a {
            color: #146ef5;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="caixa">
        <h1>GuiBeStore</h1>
        <h2>Criar conta</h2>

        <p class="mensagem"><?= $mensagem ?></p>

        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email">

            <label for="senha">Senha</label>
            <input type="text" id="senha" name="senha">

            <button type="submit">Criar</button>
        </form>

        <p>
            <a href="login.php">Voltar para o login</a>
        </p>
    </div>
</body>
</html>
