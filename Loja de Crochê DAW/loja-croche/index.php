<?php
require_once 'classes/Produto.php';
$produtoManager = new Produto();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojinha de Crochê da Vibe</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header id="inicio">
        <h1>Crochê da Vibe</h1>
        <p>Peças artesanais revendidas com amor</p>
    </header>

    <nav>
        <a href="#produtos">Produtos</a>
        <a href="#sobre">Sobre</a>
        <a href="#contato">Contato</a>
        <a href="pages/carrinho-page.php">Carrinho</a>
    </nav>

    <!-- Seção de produtos -->
    <section id="produtos" class="produtos">
        <?php foreach ($produtoManager->getTodosProdutos() as $prod_id => $produto): ?>
            <div class="produto">
                <a href="pages/produto-page.php?id=<?php echo $prod_id; ?>">
                    <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                    <h3><?php echo $produto['nome']; ?></h3>
                    <p class="preco">R$ <?php echo $produtoManager->formatarPreco($produto['preco']); ?></p>
                </a>
                <a href="pages/produto-page.php?id=<?php echo $prod_id; ?>" class="btn-comprar">Ver Detalhes</a>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Seção de sobre -->
    <section id="sobre" class="sobre">
        <h2>Sobre Nós</h2>
        <p>Feito pelos amantes do crochê: Walter, Puyol e LP</p>
    </section>

    <!-- Seção de contato -->
    <footer id="contato">
        <h2>Contato</h2>
        <div class="contato-info">
            <p>&copy; 2025 Crochê da Vibe</p>
            <p>Não existe o contato ainda pessoal</p>
        </div>
    </footer>
</body>
</html> 