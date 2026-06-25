<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'administrador') {
    header('Location: ../login.php');
    exit;
}

require '../conecta.php';

$resultado = mysqli_query($conexao, 'SELECT * FROM produtos ORDER BY id DESC');
$produtos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

$titulo = 'Administração';
$prefixo = '../';
require '../cabecalho.php';
?>
<main class="conteiner conteudo-pagina">
    <div class="titulo-secao">
        <h1>Gerenciar produtos</h1>
        <a class="botao botao-principal" href="produto-form.php">Cadastrar produto</a>
    </div>

    <?php if (count($produtos) == 0): ?>
        <div class="vazio">Nenhum produto cadastrado.</div>
    <?php else: ?>
        <div class="area-tabela">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($produtos as $produto): ?>
                    <?php
                    $imagem = $produto['imagem'];
                    if ($imagem == '') {
                        $imagem = 'assets/sem-imagem.svg';
                    }
                    if (strpos($imagem, 'http') !== 0) {
                        $imagem = '../' . $imagem;
                    }
                    ?>

                    <tr>
                        <td class="produto-tabela">
                            <img src="<?= htmlspecialchars($imagem) ?>" alt="Produto">
                            <?= htmlspecialchars($produto['nome']) ?>
                        </td>
                        <td><?= htmlspecialchars($produto['descricao']) ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td class="acoes">
                            <a class="botao botao-pequeno" href="produto-form.php?id=<?= $produto['id'] ?>">Editar</a>

                            <form method="post" action="produto-excluir.php">
                                <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">
                                <button class="botao botao-perigo botao-pequeno">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</main>
<?php require '../rodape.php'; ?>
