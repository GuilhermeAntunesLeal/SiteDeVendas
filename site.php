<?php
require 'conecta.php';

$id_usuario = $_GET['id_usuario'] ?? '';
$nome_usuario = $_GET['nome_usuario'] ?? '';
$tipo_usuario = $_GET['tipo_usuario'] ?? '';

$sql = "SELECT * FROM produtos ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>GuiBeStore</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        header {
            padding: 20px 50px;
            background: white;
            display: flex;
            justify-content: space-between;
        }

        header a {
            margin-left: 15px;
            color: #146ef5;
            text-decoration: none;
            font-weight: bold;
        }

        .banner {
            padding: 60px;
            color: white;
            background: linear-gradient(120deg, #07142f, #1477ef);
        }

        .produtos {
            width: 90%;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 15px;
            border: 1px solid #ddd;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            background: #eee;
        }

        button, .botao {
            padding: 10px;
            background: #146ef5;
            color: white;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        footer {
            padding: 25px;
            text-align: center;
            background: #222;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <strong>GuiBeStore</strong>
        <nav>
            <span>Olá, <?= $nome_usuario ?></span>
            <a href="site.php?id_usuario=<?= $id_usuario ?>&nome_usuario=<?= $nome_usuario ?>&tipo_usuario=<?= $tipo_usuario ?>">Produtos</a>
            <a href="pagar.php?id_usuario=<?= $id_usuario ?>&nome_usuario=<?= $nome_usuario ?>&tipo_usuario=<?= $tipo_usuario ?>">Minhas compras</a>

            <?php if ($tipo_usuario == 'administrador') { ?>
                <a href="formulario.html">Cadastrar produto</a>
            <?php } ?>

            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="banner">
        <h1>Produtos abaixo</h1>
    </div>

    <div class="produtos">
        <?php while ($produto = mysqli_fetch_assoc($resultado)) { ?>
            <?php
            $imagem = $produto['imagem'];
            if ($imagem == '') {
                $imagem = 'assets/sem-imagem.svg';
            }
            ?>

            <div class="card">
                <img src="<?= $imagem ?>">
                <h3><?= $produto['nome'] ?></h3>
                <p><?= $produto['descricao'] ?></p>
                <h3>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></h3>

                <form method="post" action="compra.php">
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?= $id_usuario ?>">
                    <input type="hidden" id="nome_usuario" name="nome_usuario" value="<?= $nome_usuario ?>">
                    <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="<?= $tipo_usuario ?>">
                    <input type="hidden" id="id_produto" name="id_produto" value="<?= $produto['id'] ?>">
                    <button type="submit">Comprar</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <footer>
        <p>Loja do GuiBe</p>
    </footer>
</body>
</html>
