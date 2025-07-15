using System;
using System.Text.RegularExpressions;

class Program
{
    public static void Main()
    {
        Menu();
    }

    public static void Menu()
    {
        System.Console.WriteLine("Escolha uma opção: ");
        System.Console.WriteLine("1 - Validar Senha");
        System.Console.WriteLine("2 - Ler arquivo prize.json");

        if (int.TryParse(Console.ReadLine(), out int opcao) && opcao == 1)
            Senha();

        else
            LerArquivo();
    }

    public static void Senha()
    {
        string padrao = @"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()+=_\-{}\[\]:;""'?<>,.]).{7,16}$";

        Console.WriteLine("\nDigite uma senha que contenha:");
        Console.WriteLine("- Entre 7 e 16 caracteres");
        Console.WriteLine("- Pelo menos uma letra minúscula");
        Console.WriteLine("- Pelo menos uma letra maiúscula");
        Console.WriteLine("- Pelo menos um número");
        Console.WriteLine("- Pelo menos um caractere especial");

        while (true)
        {
            Console.Write("\nSenha: ");

            string senha = Console.ReadLine();
            bool senhaValida = Regex.IsMatch(senha, padrao);

            if (senhaValida)
            {
                Console.WriteLine("Senha válida!");
                break;
            }

            else
                Console.WriteLine("Senha inválida. Tente novamente.");
        }
    }

    public static void LerArquivo()
    {
        string caminhoArquivo = Path.Combine(Directory.GetCurrentDirectory(), "prize.json");

        try
        {
            if (File.Exists(caminhoArquivo))
            {
                string conteudo = File.ReadAllText(caminhoArquivo);
                
                string pattern = @"""category""\s*:\s*""economics"".*?""firstname""\s*:\s*""([^""]+)""";
                var matches = Regex.Matches(conteudo, pattern, RegexOptions.Singleline);

                Console.WriteLine("\nPrimeiros nomes dos ganhadores de Economia:");
                foreach (Match match in matches)
                {
                    string firstName = match.Groups[1].Value;
                    Console.WriteLine($"- {firstName}");
                }
            }
            else
            {
                Console.WriteLine("Arquivo não encontrado.");
            }
        }

        catch (Exception ex)
        {
            Console.WriteLine($"Erro ao ler o arquivo: {ex.Message}");
        }
    }
}