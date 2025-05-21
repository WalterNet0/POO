using System;
using System.Net;
using System.Net.Sockets;
using System.Text;

namespace Player1;

public class Connection {
    private NetworkStream? stream;
    private TcpClient? client;

    public void StartServer(int port)
    {
        var listener = new TcpListener(IPAddress.Any, port);
        listener.Start();

        Console.WriteLine();
        Console.WriteLine($"Aguardando Player2 na porta {port}...");

        client = listener.AcceptTcpClient();
        stream = client.GetStream();

        Console.WriteLine("Player2 conectado!");
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
