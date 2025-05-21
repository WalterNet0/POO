using System;

namespace Player2;

public class AttackBoard {
    private char[,] attackBoard = new char[10, 10];
    private Connection? connection;

    public AttackBoard(Connection connection) {
        this.connection = connection;

        // Inicializa o tabuleiro com '~' (água)
        for (int r = 0; r < 10; r++)
        for (int c = 0; c < 10; c++)
            attackBoard[r, c] = '~';
    }

    public void PrintAttackBoard() {
        Console.WriteLine("Tabuleiro de Ataque:");
        Console.Write("   ");

        for (int c = 0; c < 10; c++) 
            Console.Write($"{c} ");

        Console.WriteLine();

        for (int r = 0; r < 10; r++) {
            Console.Write($"{(char)('A' + r)}  ");

            for (int c = 0; c < 10; c++) 
                Console.Write($"{attackBoard[r, c]} ");

            Console.WriteLine();
        }
    }

    public void MarkAttack(string pos, string result) {
        int row = char.ToUpper(pos[0]) - 'A';
        int col = int.Parse(pos.Substring(1));

        if (result.Equals("HIT!"))
            // Atingido
            attackBoard[row, col] = 'X';

        else if (result.Equals("MISS!") && attackBoard[row, col] == '~')
            // Errou
            attackBoard[row, col] = 'O';
    }
    public bool IsValidCoord(string pos) {
        // A posição só tem 2 caracteres
        if(pos.Length < 2 || pos.Length > 3) 
            return false;

        char rowChar = char.ToUpper(pos[0]);

        // Verificando se a letra é alguma das linhas
        if(rowChar < 'A' || rowChar > 'J') 
            return false;

        int row = rowChar - 'A';

        // Verificando se a coluna é um número, por exemplo, 'A1' invés de 'A!'
        if(!int.TryParse(pos.Substring(1), out int col))
            return false;

        // Verificando se a coluna é um número entre 0 e 9
        if(col < 0 || col > 9)
            return false;

        return true;
    }
}