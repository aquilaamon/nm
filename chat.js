const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

const YOUR_WHATSAPP_API_KEY = 'fdf0c4c5f6f18514a14ccd36c221a3da-a14b8d81-f498-4a5e-8fdd-afcb4201ca62';  // Replace with your WhatsApp API key
const WHATSAPP_NUMBER_ID = '+254112554165';  // Replace with your WhatsApp number ID

// Endpoint to send a message
app.post('/send-message', async (req, res) => {
    const { to, message } = req.body;
    try {
        const response = await axios.post(
            `https://graph.facebook.com/v15.0/${WHATSAPP_NUMBER_ID}/messages`,
            {
                messaging_product: "whatsapp",
                to: to,
                text: { body: message },
            },
            {
                headers: {
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${YOUR_WHATSAPP_API_KEY}`,
                },
            }
        );
        res.status(200).send(response.data);
    } catch (error) {
        console.error('Error sending message:', error);
        res.status(500).send('Failed to send message');
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
