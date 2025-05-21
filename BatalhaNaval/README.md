#Batalha Naval

Este é um projeto de um jogo Batalha Naval entre dois jogadores usando console e comunicação via TCP/IP com TcpClient e TcpListener.

O jogo é dividido em dois projetos (Player1 e Player2) que se comunicam por meio de sockets.

**Estrutura do Projeto**

Player1: atua como servidor. Possui o tabuleiro de defesa e recebe os ataques.
Player2: atua como cliente. Controla os ataques e mostra o tabuleiro de ataque.

**Executando o projeto**

Compile e inicie os dois projetos:

Player1.csproj (aguardará conexão do Player2)
dotnet run --project Player1

Player2.csproj (conectará ao Player1, 127.0.0.1:5000)
dotnet run --project Player2

**Legenda dos Tabuleiros**

~ = água
* = navio (somente visível para Player1)
X = acerto
O = erro

**Exemplo de Execução**

Player2 digita: C3
Resposta: HIT!
Tabuleiro de Ataque é atualizado com X em C3.
