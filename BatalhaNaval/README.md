# 🛳️ Batalha Naval - Multiplayer via Console

Este é um projeto de um jogo **Batalha Naval** entre dois jogadores usando **console** e comunicação via **TCP/IP** com `TcpClient` e `TcpListener`.

O jogo é dividido em dois projetos (`Player1` e `Player2`) que se comunicam por meio de **sockets**.

---

## 📂 **Estrutura do Projeto**

- **Player1**: atua como **servidor**. Possui o tabuleiro de defesa e recebe os ataques.  
- **Player2**: atua como **cliente**. Controla os ataques e mostra o tabuleiro de ataque.

---

## 🚀 **Executando o Projeto**

1. Compile e inicie os dois projetos com o comando `dotnet run`.

### 🖥️ Player1 (Servidor)

Aguardará conexão do Player2:
```bash
dotnet run --project Player1
```

### 🎮 Player2 (Cliente)

Conectará ao Player1 (127.0.0.1:5000):
```bash
dotnet run --project Player2
```

---

## 🧾 **Legenda dos Tabuleiros**

| Símbolo | Significado                          |
|---------|--------------------------------------|
| `~`     | Água                                 |
| `*`     | Navio (somente visível para Player1) |
| `X`     | Acerto                               |
| `O`     | Erro (tiro na água)                  |

---

## 🎯 **Exemplo de Execução**

```plaintext
Player2 digita: C3
Resposta: HIT!
Tabuleiro de Ataque é atualizado com X em C3.
```
