<?php
class Produto {
    private $produtos = [];

    //Construtor da classe Produto com os 4 produtos exemplos, seus preços e respectivas imagens com descrições
    public function __construct() {
        $this->produtos = [
            1 => [
                'nome' => 'Casal Amigurumi de Coelho',
                'preco' => 89.90,
                'imagem' => 'https://http2.mlstatic.com/D_NQ_NP_790291-MLB49597169163_042022-O.webp',
                'descricao' => 'Lindo casal de coelhos amigurumi feito à mão com fios de algodão de alta qualidade. Perfeito para decoração ou presente para todas as idades.',
                'imagens' => [
                    'https://http2.mlstatic.com/D_NQ_NP_790291-MLB49597169163_042022-O.webp',
                    'https://http2.mlstatic.com/D_NQ_NP_679686-MLB49597145379_042022-O.webp',
                    'https://http2.mlstatic.com/D_NQ_NP_683951-MLB49597164194_042022-O.webp'
                ]
            ],
            2 => [
                'nome' => 'Manta Decorativa',
                'preco' => 159.90,
                'imagem' => 'https://karsten.vtexassets.com/arquivos/ids/200678/3993592_01.jpg?v=638561260928030000&width=800&height=800&aspect=true',
                'descricao' => 'Manta decorativa em crochê, confeccionada com fios antialérgicos. Ideal para decorar sofás e camas.',
                'imagens' => [
                    'https://karsten.vtexassets.com/arquivos/ids/200678/3993592_01.jpg?v=638561260928030000&width=800&height=800&aspect=true',
                    'https://karsten.vtexassets.com/arquivos/ids/202358/3993592_02.jpg?v=638561265036300000&width=800&height=800&aspect=true',
                    'https://karsten.vtexassets.com/arquivos/ids/206189/3993592_04.jpg?v=638594134361300000&width=800&height=800&aspect=true'
                ]
            ],
            3 => [
                'nome' => 'Capa de Botijão de Gás',
                'preco' => 79.90,
                'imagem' => 'https://img.elo7.com.br/product/main/48C1698/capa-para-botijao-de-gas-em-croche-feito-a-mao.jpg',
                'descricao' => 'Capa decorativa para botijão de gás em crochê, feita à mão com fios resistentes. Deixe sua cozinha mais charmosa com este item único.',
                'imagens' => [
                    'https://img.elo7.com.br/product/zoom/48C1698/capa-para-botijao-de-gas-em-croche-feito-a-mao.jpg',
                    'https://img.elo7.com.br/product/zoom/48C169A/capa-para-botijao-de-gas-em-croche-decoracao.jpg',
                    'https://img.elo7.com.br/product/zoom/48C169C/capa-para-botijao-de-gas-em-croche-dia-das-maes.jpg'
                ]
            ],
            4 => [
                'nome' => 'Tapete Redondo',
                'preco' => 129.90,
                'imagem' => 'https://http2.mlstatic.com/D_NQ_NP_925321-MLB82458119484_022025-O.webp',
                'descricao' => 'Tapete redondo em crochê, feito com fio de malha. Perfeito para decorar qualquer ambiente.',
                'imagens' => [
                    'https://http2.mlstatic.com/D_NQ_NP_925321-MLB82458119484_022025-O.webp',
                    'https://http2.mlstatic.com/D_NQ_NP_686664-MLB77866726009_072024-O.webp',
                    'https://http2.mlstatic.com/D_NQ_NP_650939-MLB74501112082_022024-O.webp'
                ]
            ]
        ];
    }

    //Método para retornar todos os produtos
    public function getTodosProdutos() {
        return $this->produtos;
    }

    //Método para retornar um produto específico pelo ID
    public function getProduto($id) {
        return isset($this->produtos[$id]) ? $this->produtos[$id] : null;
    }

    //Método para formatar o preço para o padrão(R$)
    public function formatarPreco($preco) {
        return number_format($preco, 2, ',', '.'); //Separador de milhar = . e separador de decimal = ,
    }

    //Método para verificar se um produto existe pelo ID
    public function produtoExiste($id) {
        return isset($this->produtos[$id]);
    }
} 