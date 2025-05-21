using System;

namespace Player1;

public class Program {
    public static void Main(string[] args) {
        Connection connection = new Connection();
        Board board = new Board();

        board.Menu();

        int counter = 0;

        // Inicia o servidor
        connection.StartServer(5000);

        // Loop de defesa
        while (true)
        {
            string ataque = connection.Receive();

            Console.WriteLine();
            Console.WriteLine($"Ataque recebido: {ataque}");

            bool hit = board.IsHit(ataque);

            if (board.CheckWin())
            {
                counter++;

                connection.Send("WIN!");

                Console.WriteLine();
                Console.WriteLine("Tabuleiro de Defesa:");
                board.Print(true);

                Console.WriteLine();
                Console.WriteLine("Você perdeu! Todos os navios foram atingidos.");

                Console.WriteLine($"Ataques recebidos totais: {counter}");
                break;
            }

            connection.Send(hit ? "HIT!" : "MISS!");
            counter++;

            Console.WriteLine();
            Console.WriteLine("Tabuleiro de Defesa:");
            board.Print(true);
        }

        connection.Close();
    }
}