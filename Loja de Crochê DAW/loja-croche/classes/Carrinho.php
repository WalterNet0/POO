<?php
session_start();

class Carrinho {
    public function __construct() {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    //Método para adicionar um produto ao carrinho
    public function adicionar($id) {
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]++;
        } else {
            $_SESSION['carrinho'][$id] = 1;
        }
    }

    //Método para remover um produto do carrinho
    public function remover($id) {
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    //Método para atualizar a quantidade de um produto no carrinho
    public function atualizar($id, $quantidade) {
        if ($quantidade > 0) {
            $_SESSION['carrinho'][$id] = $quantidade;
        } else {
            $this->remover($id);
        }
    }

    //Método para obter a quantidade de um produto no carrinho
    public function getQuantidade($id) {
        return isset($_SESSION['carrinho'][$id]) ? $_SESSION['carrinho'][$id] : 0;
    }

    //Método para obter o total de produtos no carrinho
    public function getTotal() {
        return array_sum($_SESSION['carrinho']);
    }

    //Método para obter os itens do carrinho
    public function getItens() {
        return $_SESSION['carrinho'];
    }

    //Método para limpar o carrinho
    public function limpar() {
        $_SESSION['carrinho'] = [];
    }
} 