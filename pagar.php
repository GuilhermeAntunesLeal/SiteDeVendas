<?php
require 'conecta.php';

$id_usuario = $_GET['id_usuario'] ?? '';
$nome_usuario = $_GET['nome_usuario'] ?? '';
$tipo_usuario = $_GET['tipo_usuario'] ?? '';

$sql = "SELECT compras.*, produtos.nome
        FROM compras
        JOIN produtos ON produtos.id = compras.produto_id
        WHERE compras.usuario_id = $id_usuario";

$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minhas compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        .caixa {
            width: 80%;
            margin: 40px auto;
            background: white;
            padding: 20px;
        }

        .item {
            border-bottom: 1px solid #ddd;
            padding: 15px;
        }

        a {
            color: #146ef5;
            font-weight: bold;
        }

        button {
            padding: 8px;
            background: #c62828;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="caixa">
        <h1>Minhas compras</h1>
        <a href="site.php?id_usuario=<?= $id_usuario ?>&nome_usuario=<?= $nome_usuario ?>&tipo_usuario=<?= $tipo_usuario ?>">Voltar</a>

        <?php while ($compra = mysqli_fetch_assoc($resultado)) { ?>
            <div class="item">
                <strong><?= $compra['nome'] ?></strong>
                <p>Quantidade: <?= $compra['quantidade'] ?></p>
                <p>Total: R$ <?= number_format($compra['preco_unitario'] * $compra['quantidade'], 2, ',', '.') ?></p>

                <form method="post" action="remover.php">
                    <input type="hidden" id="id_compra" name="id_compra" value="<?= $compra['id'] ?>">
                    <input type="hidden" id="id_usuario" name="id_usuario" value="<?= $id_usuario ?>">
                    <input type="hidden" id="nome_usuario" name="nome_usuario" value="<?= $nome_usuario ?>">
                    <input type="hidden" id="tipo_usuario" name="tipo_usuario" value="<?= $tipo_usuario ?>">
                    <button type="submit">Remover</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>
</html>
