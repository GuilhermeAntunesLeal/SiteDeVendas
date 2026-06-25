<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

require 'conecta.php';

$resultado = mysqli_query($conexao, 'SELECT * FROM produtos ORDER BY id DESC');
$produtos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

$titulo = 'Produtos';
require 'cabecalho.php';
?>
<section class="destaque">
    <p class="chamada">GuiBeStore</p>
    <h1>Produtos a baixo</h1>
</section>

<main class="conteiner">
    <div class="titulo-secao">
        <h2>Produtos</h2>
        <span><?= count($produtos) ?> produto(s)</span>
    </div>

    <?php if (count($produtos) == 0): ?>
        <div class="vazio">Nenhum produto cadastrado.</div>
    <?php else: ?>
        <div class="grade-produtos">
            <?php foreach ($produtos as $produto): ?>
                <?php
                $imagem = $produto['imagem'];
                if ($imagem == '') {
                    $imagem = 'assets/sem-imagem.svg';
                }
                ?>

                <div class="card-produto">
                    <div class="imagem-produto">
                        <img src="<?= htmlspecialchars($imagem) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                    </div>

                    <div class="info-produto">
                        <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                        <p class="descricao-produto"><?= htmlspecialchars($produto['descricao']) ?></p>

                        <div class="rodape-produto">
                            <span class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>

                            <?php if ($_SESSION['usuario']['tipo'] == 'administrador'): ?>
                                <a class="botao" href="admin/produto-form.php?id=<?= $produto['id'] ?>">Editar</a>
                            <?php else: ?>
                                <form method="post" action="comprar.php">
                                    <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
                                    <button class="botao botao-escuro">Comprar</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php require 'rodape.php'; ?>
