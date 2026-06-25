<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['usuario']['tipo'] == 'administrador') {
    header('Location: admin/index.php');
    exit;
}

require 'conecta.php';

$usuarioId = (int) $_SESSION['usuario']['id'];
$sql = "SELECT compras.*, produtos.nome, produtos.imagem
        FROM compras
        JOIN produtos ON produtos.id = compras.produto_id
        WHERE compras.usuario_id = $usuarioId
        ORDER BY compras.id DESC";

$resultado = mysqli_query($conexao, $sql);
$compras = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

$titulo = 'Minhas compras';
require 'cabecalho.php';
?>
<main class="conteiner conteudo-pagina">
    <div class="titulo-secao">
        <h1>Minhas compras</h1>
        <a class="botao" href="loja.php">Voltar para a loja</a>
    </div>

    <?php if (count($compras) == 0): ?>
        <div class="vazio">Você ainda não realizou nenhuma compra.</div>
    <?php else: ?>
        <div class="lista-compras">
            <?php foreach ($compras as $compra): ?>
                <?php
                $imagem = $compra['imagem'];
                if ($imagem == '') {
                    $imagem = 'assets/sem-imagem.svg';
                }
                ?>

                <div class="item-compra">
                    <img src="<?= htmlspecialchars($imagem) ?>" alt="Produto">
                    <strong><?= htmlspecialchars($compra['nome']) ?></strong>
                    <span><?= $compra['quantidade'] ?> unidade(s)</span>
                    <strong>R$ <?= number_format($compra['preco_unitario'] * $compra['quantidade'], 2, ',', '.') ?></strong>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php require 'rodape.php'; ?>
