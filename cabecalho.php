<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$titulo = $titulo ?? 'GuiBeStore';
$prefixo = $prefixo ?? '';
$mensagem = $_SESSION['mensagem'] ?? null;
unset($_SESSION['mensagem']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?> | GuiBeStore</title>
    <link rel="stylesheet" href="<?= $prefixo ?>style.css?v=6">
</head>
<body>
<header class="cabecalho">
    <a class="marca" href="<?= $prefixo ?>loja.php">GuiBe<span>Store</span></a>

    <nav>
        <a href="<?= $prefixo ?>loja.php">Produtos</a>

        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo'] == 'administrador'): ?>
            <a href="<?= $prefixo ?>admin/index.php">Administração</a>
        <?php else: ?>
            <a href="<?= $prefixo ?>minhas-compras.php">Minhas compras</a>
        <?php endif; ?>
    </nav>

    <div class="menu-usuario">
        <span>Olá, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?></span>
        <a class="botao botao-pequeno" href="<?= $prefixo ?>logout.php">Sair</a>
    </div>
</header>

<?php if ($mensagem): ?>
    <div class="alerta alerta-<?= htmlspecialchars($mensagem['tipo']) ?>">
        <?= htmlspecialchars($mensagem['texto']) ?>
    </div>
<?php endif; ?>
