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
        <a href="index.php">Início</a>
        <?php 
        // Caso esteja na página de um produto, retorna à página Produtos
        if (isset($_GET['id'])): ?>
            <a href="index.php">Produtos</a>
        <?php else: ?>
            <a href="#produtos">Produtos</a>
        <?php endif; ?>
        <a href="#sobre">Sobre</a>
        <a href="#contato">Contato</a>
    </nav>

    <?php
    require_once 'Produto.php';
    $produtoManager = new Produto();
    
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    // Se não tiver ID ou o ID não existir, mostra a lista de produtos
    if ($id === 0 || !$produtoManager->produtoExiste($id)) {
    ?>
        <div class="banner">
            <h2>Bem-vindo à nossa loja!</h2>
            <p>Descubra peças únicas feitas à mão com muito carinho</p>
        </div>

        <section id="produtos" class="produtos">
            <?php foreach ($produtoManager->getTodosProdutos() as $prod_id => $produto): ?>
                <div class="produto">
                    <a href="?id=<?php echo $prod_id; ?>">
                        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                        <h3><?php echo $produto['nome']; ?></h3>
                        <p class="preco">R$ <?php echo $produtoManager->formatarPreco($produto['preco']); ?></p>
                    </a>
                    <a href="?id=<?php echo $prod_id; ?>" class="btn-comprar">Comprar</a>
                </div>
            <?php endforeach; ?>
        </section>
    <?php
    } else {
        // Se tiver ID válido, mostra os detalhes do produto
        $produto = $produtoManager->getProduto($id);
    ?>
        <div class="produto-detalhes">
            <a href="index.php" class="voltar">← Voltar para produtos</a>
            <h2><?php echo $produto['nome']; ?></h2>
            
            <div class="galeria-produtos">
                <?php foreach ($produto['imagens'] as $index => $imagem): ?>
                    <div class="imagem-produto">
                        <img src="<?php echo $imagem; ?>" alt="<?php echo $produto['nome'] . ' - Imagem ' . ($index + 1); ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="info-produto">
                <p class="descricao"><?php echo $produto['descricao']; ?></p>
                <p class="preco">R$ <?php echo $produtoManager->formatarPreco($produto['preco']); ?></p>
                <button class="btn-comprar">Adicionar ao Carrinho</button>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- Só a sessãozinha de baixo com o rodapé -->
    <section id="sobre" class="sobre">
            <h2>Sobre Nós</h2>
            <p>
                Feito pelos amantes do crochê: Walter, Puyol e LP
            </p>
        </section>

    <footer id="contato">
        <h2>Contato</h2>
        <div class="contato-info">
            <p>&copy; 2025 Crochê da Vibe</p>
            <p>Não existe o contato ainda pessoal</p>
            <p>WhatsApp: Sem whatsapp também</p>
        </div>
    </footer>
</body>
</html> 