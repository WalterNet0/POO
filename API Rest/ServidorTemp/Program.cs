using System;
using System.Net.Http;
using System.Threading.Tasks;

public class Program
{
    public static async Task Main(string[] args)
    {
        string unidade = "";
        int intervalo = 0;

        //Loop para solicitar a unidade de Temperatura
        while (true)
        {
            Console.Write("Digite a unidade de temperatura desejada (Celsius, Kelvin ou Fahrenheit): ");
            string? input = Console.ReadLine();

            if (string.IsNullOrEmpty(input))
            {
                Console.WriteLine("Entrada inválida. Por favor, digite um valor.\n");
                continue;
            }

            unidade = input.ToLower();

            if (unidade != "celsius" && unidade != "kelvin" && unidade != "fahrenheit")
            {
                Console.WriteLine("Unidade inválida. Por favor, insira 'Celsius', 'Kelvin' ou 'Fahrenheit'.\n");
                continue;
            }

            Console.WriteLine();
            break;
        }

        //Loop para solicitar o intervalo de tempo
        while (true)
        {
            Console.Write("Digite o intervalo de tempo em segundos: ");
            string? input = Console.ReadLine();

            if (string.IsNullOrEmpty(input))
            {
                Console.WriteLine("Entrada inválida. Por favor, digite um valor.\n");
                continue;
            }

            if (!int.TryParse(input, out intervalo) || intervalo <= 0)
            {
                Console.WriteLine("Intervalo inválido. Por favor, insira um número positivo.\n");
                continue;
            }

            Console.WriteLine();
            break;
        }

        var builder = WebApplication.CreateBuilder(args);
        builder.WebHost.UseUrls("http://localhost:5000");
        var app = builder.Build();

        // Configurar a rota de temperatura
        app.MapGet("/temperatura/{unidade}", (string unidade) =>
        {
            // 1) obter hora atual em horas totais (ex.: 14.5 = 14h30m)
            DateTime time = DateTime.Now;
            double t = DateTime.Now.TimeOfDay.TotalHours;

            // 2) calcular temperatura em Celsius sem ruído
            double tempCBase = 25.0 + 5.0 * Math.Sin((2.0 * Math.PI / 24.0) * t);

            // 3) adicionar ruído uniforme [0,1)
            double ruido = Random.Shared.NextDouble();
            double tempC = tempCBase + ruido;

            // 4) converter para a unidade pedida
            double resultado;
            string uni = unidade.ToLower();
            if (uni == "kelvin")
            {
                resultado = tempC + 273.15;
            }
            else if (uni == "fahrenheit")
            {
                resultado = tempC * 9.0 / 5.0 + 32.0;
            }
            else if (uni == "celsius")
            {
                resultado = tempC;
            }
            else
            {
                return Results.BadRequest(new { erro = "Unidade inválida. Use celsius, kelvin ou fahrenheit." });
            }

            // 5) retornar JSON simples: { "unidade": "...", "valor": <número> }
            return Results.Ok(new
            {
                Horário = $"[{time.ToString("HH:mm:ss")}]",
                unidade = uni,
                valor = Math.Round(resultado, 2)
            });
        });

        // Iniciar o servidor em uma nova thread
        Task.Run(() => app.Run());

        // Cliente HTTP para fazer as requisições
        using (var client = new HttpClient())
        {
            while (true)
            {
                try
                {
                    var response = await client.GetStringAsync($"http://localhost:5000/temperatura/{unidade}");
                    Console.WriteLine(response);
                }
                catch (Exception ex)
                {
                    Console.WriteLine($"Erro ao obter temperatura: {ex.Message}");
                }

                await Task.Delay(intervalo * 1000);
            }
        }
    }
}