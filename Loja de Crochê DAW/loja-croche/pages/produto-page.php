<?php
require_once '../classes/Produto.php';
require_once '../classes/Carrinho.php';

$produtoManager = new Produto();
$carrinho = new Carrinho();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Se não existir o produto, redireciona para a página inicial
if ($id === 0 || !$produtoManager->produtoExiste($id)) {
    header('Location: ../index.php');
    exit;
}

$produto = $produtoManager->getProduto($id);

// Verifica se a quantidade foi passada
$quantidade = isset($_GET['qtd']) ? (int)$_GET['qtd'] : 1;
if ($quantidade < 1) $quantidade = 1;

$subtotal = $produto['preco'] * $quantidade;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $produto['nome']; ?> - Crochê da Vibe</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Crochê da Vibe</h1>
        <p>Peças artesanais revendidas com amor</p>
    </header>

    <nav>
        <a href="../index.php">Produtos</a>
        <a href="carrinho-page.php">Carrinho</a>
    </nav>

    <div class="produto-detalhes">
        <a href="../index.php" class="voltar">← Voltar para produtos</a>
        <h2><?php echo $produto['nome']; ?></h2>
        
        <!-- Galeria de imagens do produto -->
        <div class="galeria-produtos">
            <?php foreach ($produto['imagens'] as $index => $imagem): ?>
                <div class="imagem-produto">
                    <img src="<?php echo $imagem; ?>" alt="<?php echo $produto['nome'] . ' - Imagem ' . ($index + 1); ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Informações do produto -->
        <div class="info-produto">
            <p class="descricao"><?php echo $produto['descricao']; ?></p>
            <p class="preco">R$ <?php echo $produtoManager->formatarPreco($produto['preco']); ?></p>
            
            <!-- Formulário -->
            <form method="get" class="form-quantidade" style="margin-bottom: 15px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="controle-quantidade">
                    <label for="qtd">Quantidade:</label>
                    <input type="number" name="qtd" id="qtd" value="<?php echo $quantidade; ?>" min="1"
                           style="width: 60px; margin: 0 10px;">
                </div>
                <p class="subtotal" style="margin: 10px 0;">
                    Subtotal: R$ <?php echo $produtoManager->formatarPreco($subtotal); ?>
                </p>
            </form>

            <!-- Formulário para adicionar ao carrinho -->
            <form method="get" action="carrinho-page.php" class="form-adicionar">
                <input type="hidden" name="adicionar" value="<?php echo $id; ?>">
                <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">
                <button type="submit" class="btn-comprar">Adicionar ao Carrinho</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="contato-info">
            <p>&copy; 2025 Crochê da Vibe</p>
        </div>
    </footer>
</body>
</html>
