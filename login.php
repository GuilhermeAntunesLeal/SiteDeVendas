<?php
session_start();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['tipo'] == 'administrador') {
        header('Location: admin/index.php');
    } else {
        header('Location: loja.php');
    }
    exit;
}

$erro = '';
$mensagem = $_SESSION['mensagem'] ?? null;
unset($_SESSION['mensagem']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'conecta.php';

    $email = mysqli_real_escape_string($conexao, trim($_POST['email'] ?? ''));
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        unset($usuario['senha']);
        $_SESSION['usuario'] = $usuario;

        if ($usuario['tipo'] == 'administrador') {
            header('Location: admin/index.php');
        } else {
            header('Location: loja.php');
        }
        exit;
    } else {
        $erro = 'E-mail ou senha inválidos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | GuiBeStore</title>
    <link rel="stylesheet" href="style.css?v=6">
</head>
<body class="pagina-login">
<main class="cartao-login">
    <a class="marca marca-login" href="login.php">GuiBe<span>Store</span></a>
    <h1>Entrar</h1>
    <p class="texto-fraco">Digite seu e-mail e sua senha.</p>

    <?php if ($mensagem): ?>
        <div class="alerta alerta-<?= htmlspecialchars($mensagem['tipo']) ?>">
            <?= htmlspecialchars($mensagem['texto']) ?>
        </div>
    <?php endif; ?>

    <?php if ($erro): ?>
        <div class="alerta alerta-erro"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" class="formulario">
        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <button class="botao botao-principal botao-bloco">Entrar</button>
    </form>
</main>
</body>
</html>
