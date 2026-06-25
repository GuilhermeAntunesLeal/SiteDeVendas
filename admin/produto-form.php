<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'administrador') {
    header('Location: ../login.php');
    exit;
}

require '../conecta.php';

$produto = ['id' => '', 'nome' => '', 'descricao' => '', 'preco' => '', 'imagem' => ''];
$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    $resultado = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id");
    $produto = mysqli_fetch_assoc($resultado);

    if (!$produto) {
        header('Location: index.php');
        exit;
    }
}

$titulo = $id > 0 ? 'Editar produto' : 'Cadastrar produto';
$prefixo = '../';
require '../cabecalho.php';
?>
<main class="conteiner conteudo-pagina estreito">
    <div class="titulo-secao">
        <h1><?= $titulo ?></h1>
        <a class="botao" href="index.php">Voltar</a>
    </div>

    <form class="painel formulario" method="post" action="produto-salvar.php">
        <input type="hidden" name="id_produto" value="<?= $produto['id'] ?>">

        <label>Nome</label>
        <input name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

        <label>Descrição</label>
        <textarea name="descricao" rows="5" required><?= htmlspecialchars($produto['descricao']) ?></textarea>

        <label>Preço</label>
        <input name="preco" type="number" step="0.01" value="<?= $produto['preco'] ?>" required>

        <label>Imagem (URL ou caminho)</label>
        <input name="imagem" value="<?= htmlspecialchars($produto['imagem']) ?>">

        <button class="botao botao-principal">Salvar</button>
    </form>
</main>
<?php require '../rodape.php'; ?>
