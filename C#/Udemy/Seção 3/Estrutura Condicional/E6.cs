using System;
using System.Globalization;

namespace Course {
    class Program {
        public static void Main(string[] args) {
            Console.WriteLine("Digite um valor: ");
            double valor = double.Parse(Console.ReadLine(), CultureInfo.InvariantCulture);
            
            if(valor < 0 || valor > 100)
                Console.WriteLine("Valor fora do intervalo!");
            
            else if(valor >= 0 && valor <= 25)
                Console.WriteLine("Intervalo [0, 25]");
            
            else if(valor >= 25 && valor <= 50)
                Console.WriteLine("Intervalo [25, 50]");
            
            else if(valor >= 50 && valor <= 75)
                Console.WriteLine("Intervalo [50, 75]");
            
            else if(valor >= 75 && valor <= 100)
                Console.WriteLine("Intervalo [75, 100]");
        }   
    }
}
