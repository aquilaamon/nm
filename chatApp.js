const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 8080 });

let clients = [];

wss.on('connection', function connection(ws) {
    console.log('A new client connected');
    clients.push(ws);

    ws.on('message', function incoming(message) {
        console.log('Received message:', message);

        // Broadcast the message to all connected clients
        clients.forEach(client => {
            if (client.readyState === WebSocket.OPEN) {
                client.send(message);
            }
        });
    });

    ws.on('error', function (error) {
        console.error('WebSocket error:', error);
    });

    ws.on('close', function () {
        console.log('Client disconnected');
        clients = clients.filter(client => client !== ws);
    });

    ws.send(JSON.stringify({ sender: 'Server', text: 'Welcome to the chat!' }));
});

wss.on('error', function (error) {
    console.error('WebSocket Server error:', error);
});

console.log('WebSocket server is running on ws://localhost:8080');
