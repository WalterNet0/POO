﻿namespace Player2;

public class Program {
    public static void Main(string[] args) {
        Connection connection = new Connection();
        connection.ConnectToServer("127.0.0.1", 5000);

        AttackBoard board = new AttackBoard(connection);

        int counter = 0;

        board.PrintAttackBoard();

        while (true)
        {

            Console.WriteLine();
            Console.Write("Digite a posição para atacar (ex: A1): ");
            string pos = Console.ReadLine();

            // Verifica se a posição é válida
            if (!board.IsValidCoord(pos))
            {
                Console.WriteLine("Posição inválida. Tente novamente.");
                continue;
            }

            // Envia o ataque para o servidor
            connection.Send(pos);

            // Recebe a resposta do servidor
            string response = connection.Receive();

            int row = pos[0] - 'A';
            int col = int.Parse(pos.Substring(1));

            // Atualiza o tabuleiro de ataque com a resposta do servidor
            if (response == "HIT!")
            {
                board.MarkAttack(pos, response); // Marca como atingido
                Console.WriteLine("Você acertou!");
            }

            else if (response == "MISS!")
            {
                board.MarkAttack(pos, response);
                Console.WriteLine("Você errou!");
            }

            else if (response == "WIN!")
            {
                counter++;

                Console.WriteLine("Você acertou!");
                Console.WriteLine();
                board.PrintAttackBoard();

                Console.WriteLine();
                Console.WriteLine("Você ganhou! Todos os navios foram atingidos");
                Console.WriteLine($"Ataques realizados totais: {counter}");

                break;
            }

            else
                Console.WriteLine("Resposta inválida do servidor.");

            counter++;
            board.PrintAttackBoard();

            Console.WriteLine();
        }

        connection.Close();
    }
}