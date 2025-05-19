<?php
require_once '../classes/Produto.php';
require_once '../classes/Carrinho.php';

$produtoManager = new Produto();
$carrinho = new Carrinho();

if (isset($_GET['acao'])) {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Pega o ID do produto
    $quantidade = isset($_GET['quantidade']) ? (int)$_GET['quantidade'] : 0; // Pega a quantidade

    switch ($_GET['acao']) {
        case 'atualizar':
            if ($quantidade >= 1) {
                $carrinho->atualizar($id, $quantidade); // Atualiza quantidade se for válida
            } else {
                $_SESSION['erro'] = 'A quantidade mínima é 1';
            }
            break;
        case 'remover':
            $carrinho->remover($id); // Remove o item do carrinho
            break;
    }
}

if (isset($_GET['adicionar'])) {
    $id = (int)$_GET['adicionar'];

    // Verifica se o produto existe
    if ($produtoManager->produtoExiste($id)) {
        $quantidade = isset($_GET['quantidade']) ? max(1, (int)$_GET['quantidade']) : 1;

        // Adiciona o produto ao carrinho na quantidade informada
        for ($i = 0; $i < $quantidade; $i++) {
            $carrinho->adicionar($id);
        }

        header('Location: carrinho-page.php?mensagem=Produto adicionado ao carrinho!');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Crochê da Vibe</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <h1>Seu Carrinho</h1>
        <p>Confira os produtos selecionados</p>
    </header>

    <nav>
        <a href="../index.php">Produtos</a>
    </nav>

    <!-- Mensagem de sucesso após adicionar produto -->
    <?php if (isset($_GET['mensagem'])): ?>
        <div class="mensagem">
            <?php echo htmlspecialchars($_GET['mensagem']); ?>
        </div>
    <?php endif; ?>

    <div class="container-carrinho">
        <?php if ($carrinho->getTotal() > 0): ?>
            <section class="carrinho">
                <div class="itens-carrinho">
                    <?php 
                    $total = 0;

                    // Percorre todos os itens do carrinho
                    foreach ($carrinho->getItens() as $prod_id => $quantidade):
                        $produto = $produtoManager->getProduto($prod_id);
                        $subtotal = $produto['preco'] * $quantidade;
                        $total += $subtotal;
                    ?>
                        <div class="item-carrinho" id="item-<?php echo $prod_id; ?>">
                            <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                            <div class="info-item">
                                <h3><?php echo $produto['nome']; ?></h3>
                                <p>Preço unitário: R$ <?php echo $produtoManager->formatarPreco($produto['preco']); ?></p>
                                <p class="subtotal">Subtotal: R$ <?php echo $produtoManager->formatarPreco($subtotal); ?></p>

                                <!-- Formulário para atualizar quantidade -->
                                <form method="get" class="form-quantidade">
                                    <input type="hidden" name="id" value="<?php echo $prod_id; ?>">
                                    <input type="hidden" name="acao" value="atualizar">
                                    <div class="controle-quantidade">
                                        <label for="quantidade-<?php echo $prod_id; ?>">Quantidade:</label>
                                        <input type="number" name="quantidade" id="quantidade-<?php echo $prod_id; ?>" 
                                               value="<?php echo $quantidade; ?>" min="1"
                                               style="width: 60px; margin: 0 10px;">
                                    </div>
                                </form>

                                <!-- Botão para remover produto -->
                                <form method="get" class="form-remover">
                                    <input type="hidden" name="id" value="<?php echo $prod_id; ?>">
                                    <button type="submit" name="acao" value="remover" class="btn-remover">Remover</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Resumo do carrinho -->
                <div class="resumo-carrinho">
                    <h3>Resumo do Pedido</h3>
                    <p class="total">Total: R$ <?php echo $produtoManager->formatarPreco($total); ?></p>
                    <button class="btn-finalizar">Finalizar Compra</button>
                </div>
            </section>
        <?php else: ?>
            <!-- Mensagem se o carrinho estiver vazio -->
            <div class="carrinho-vazio">
                <h2>Seu carrinho está vazio</h2>
                <p>Que tal dar uma olhada em nossos produtos?</p>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <div class="contato-info">
            <p>&copy; 2025 Crochê da Vibe</p>
        </div>
    </footer>
</body>
</html>
