using System;

namespace Player1;

public class Board {
    private char[,] grid = new char[10, 10];

    public Board() {
        // Inicializa o tabuleiro com '~' (água)
        for (int r = 0; r < 10; r++)
        for (int c = 0; c < 10; c++)
            grid[r, c] = '~';
    }

    public void Menu(){
        Console.WriteLine("Bem-vindo ao Batalha Naval - Player 1!");
        Console.WriteLine("Escolha o modo de posicionamento dos navios:");
        Console.WriteLine("1. Posicionamento Aleatório de 10 navios");
        Console.WriteLine("2. Posicionamento Manual de 10 navios");

        int choice;
        while (true) {
            Console.Write("Digite sua escolha (1 ou 2): ");
            if (int.TryParse(Console.ReadLine(), out choice) && (choice == 1 || choice == 2))
                break;

            Console.WriteLine("Opção inválida. Tente novamente.");
        }

        if(choice == 1) {
            PlaceShipsRandomly(10);
        }

        else {
            Console.WriteLine("Digite as posições dos navios (ex: A1, B2, C3):");

            for (int i = 0; i < 10; i++) {
                string? pos;

                while (true) {
                    Console.Write($"Navio {i + 1}: ");
                    pos = Console.ReadLine();

                    if (!string.IsNullOrEmpty(pos) && PlaceShipsManual(pos))
                        break;

                    Console.WriteLine("Posição inválida ou já ocupada. Tente novamente.");
                }
            }
        }

        Console.WriteLine("Seus navios foram posicionados!");

        Console.WriteLine("Tabuleiro:");
        Print(true);
    }

    public void Print(bool showShips) {
        Console.Write("   ");
        for (int c = 0; c < 10; c++) Console.Write($"{c} ");
        Console.WriteLine();
        for (int r = 0; r < 10; r++)
        {
            Console.Write($"{(char)('A' + r)}  ");
            for (int c = 0; c < 10; c++)
            {
                char cell = grid[r, c];
                Console.Write(!showShips && cell == '*' ? "~ " : $"{cell} ");
            }
            Console.WriteLine();
        }
    }

    public void PlaceShipsRandomly(int n) {
        var rnd = new Random();
        int placed = 0;
        while (placed < n)
        {
            int r = rnd.Next(10), c = rnd.Next(10);
            if (grid[r, c] == '~')
            {
                grid[r, c] = '*';
                placed++;
            }
        }
    }

    public bool PlaceShipsManual(string pos) {
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

        // Verificando se a posição já está ocupada
        if(grid[row, col] != '~')
            return false;

        // Colocando o barco na posição
        grid[row, col] = '*';

        return true;    
    }

    public bool IsHit(string hit) {
        // A posição só tem 2 caracteres
        if(hit.Length < 2 || hit.Length > 3) 
            return false;

        char rowChar = char.ToUpper(hit[0]);

        // Verificando se a letra é alguma das linhas
        if(rowChar < 'A' || rowChar > 'J') 
            return false;

        int row = rowChar - 'A';

        // Verificando se a coluna é um número, por exemplo, 'A1' invés de 'A!'
        if(!int.TryParse(hit.Substring(1), out int col))
            return false;

        // Verificando se a coluna é um número entre 0 e 9
        if(col < 0 || col > 9)
            return false;

        if(grid[row, col] == '*') {
            // Marca como atingido
            grid[row, col] = 'X';
            Console.WriteLine("HIT!");

            return true;
        } 
        
        else if (grid[row, col] == '~') {
            // Marca como água
            Console.WriteLine("MISS!");

            return false;   
        }

        else if (CheckWin()) {
            Console.WriteLine("WIN!");
            return true;
        }

        // Já atingido
        return false;
    }

    public bool CheckWin() {
    for (int r = 0; r < 10; r++) {
        for (int c = 0; c < 10; c++) {
            if (grid[r, c] == '*') {
                return false; // Ainda há navios no tabuleiro
            }
        }
    }
    return true; // Todos os navios foram destruídos
}
}