import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';
import cors from 'cors';
import dotenv from 'dotenv';
import path from 'path';
import { fileURLToPath } from 'url';

// Load .env from Laravel root
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
dotenv.config({ path: path.join(__dirname, '../.env') });

const app = express();
const httpServer = createServer(app);

// Configure CORS for Express and Socket.io using APP_URL
const allowedOrigin = process.env.APP_URL || 'http://localhost';

app.use(cors({ origin: allowedOrigin }));
app.use(express.json());

const io = new Server(httpServer, {
    cors: {
        origin: allowedOrigin,
        methods: ["GET", "POST"]
    }
});

// State tracking
let activeVisitors = new Set();
const SECRET_KEY = process.env.REALTIME_SECRET || 'secret-key-for-backend-communication';

// Utility to emit updated count to all clients
function broadcastVisitorCount() {
    io.emit('visitorCountUpdate', activeVisitors.size);
}

// 1. WebSocket Connections
io.on('connection', (socket) => {
    // Add socket to active visitors
    activeVisitors.add(socket.id);
    broadcastVisitorCount();

    // Listen for page view context
    socket.on('pageView', (data) => {
        // Optional: Can broadcast specific paths to admin later
    });

    // Handle disconnect
    socket.on('disconnect', () => {
        activeVisitors.delete(socket.id);
        broadcastVisitorCount();
    });
});

// 2. HTTP Endpoint for Laravel Backend -> Node.js communication
// This allows Laravel to push events to Socket.io clients
app.post('/api/broadcast', (req, res) => {
    const { secret, event, data, room } = req.body;

    if (!secret || secret !== SECRET_KEY) {
        return res.status(403).json({ error: 'Unauthorized broadcast request' });
    }

    if (!event) {
        return res.status(400).json({ error: 'Event name is required' });
    }

    if (room) {
        io.to(room).emit(event, data);
    } else {
        io.emit(event, data);
    }

    return res.json({ success: true, message: `Event ${event} broadcasted successfully` });
});

// Start Server
const PORT = process.env.REALTIME_PORT || 3000;
httpServer.listen(PORT, () => {
    console.log(`🚀 Real-time engine flying on port ${PORT}`);
    console.log(`🔒 Allowed Origin: ${allowedOrigin}`);
});
