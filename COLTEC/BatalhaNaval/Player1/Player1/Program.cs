using System;

namespace Player1;

public class Program {
    public static void Main(string[] args) {
        Connection connection = new Connection();
        Board board = new Board();

        board.Menu();

        // Inicia o servidor
        connection.StartServer(5000);

        // Loop de defesa
        while(true){
            string ataque = connection.Receive();
            Console.WriteLine($"Ataque recebido: {ataque}");

            bool hit = board.IsHit(ataque);

            if(board.CheckWin()){
                connection.Send("WIN!");

                System.Console.WriteLine("Você perdeu! Todos os navios foram atingidos.");
                break;
            }

            connection.Send(hit ? "HIT!" : "MISS!");
        }

        connection.Close();
    }
}