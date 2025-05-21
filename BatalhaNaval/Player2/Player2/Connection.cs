using System;
using System.Net;
using System.Net.Sockets;
using System.Text;

namespace Player2;

public class Connection {
    private NetworkStream stream;
    private TcpClient client;

    public void ConnectToServer(string ip, int port) {
        client = new TcpClient();

        Console.WriteLine();
        Console.WriteLine($"Conectando ao Player1 em {ip}:{port}...");

        client.Connect(ip, port);
        stream = client.GetStream();

        Console.WriteLine("Conectado ao Player1!");
        Console.WriteLine();
    }

    public void Send(string msg) {
        var data = Encoding.ASCII.GetBytes(msg);
        stream.Write(data, 0, data.Length);
    }

    public string Receive() {
        var buf = new byte[32];
        int len = stream.Read(buf, 0, buf.Length);
        
        return Encoding.ASCII.GetString(buf, 0, len);
    }

    public void Close() {
        stream?.Close();
        client?.Close();
    }
}
