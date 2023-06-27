const express = require('express');
const multer = require('multer');
const TelegramBot = require('node-telegram-bot-api');

// Set up Express app
const app = express();
const port = process.env.PORT || 3000;

// Set up Multer for file upload
const storage = multer.diskStorage({
    destination: 'uploads/',
    filename: (req, file, cb) => {
        cb(null, file.originalname);
    }
});
const upload = multer({ storage });

// Set up Telegram Bot
const botToken = '5950338973:AAEMc2zBcEWKv5vPg7anK4DgIBvrWrM2nmM';
const chatId = '1001927046640';
const bot = new TelegramBot(botToken);

// Define route for file upload
app.post('/upload', upload.single('photo'), (req, res) => {
    const name = req.body.name;
    const whatsapp = req.body.whatsapp;
    const email = req.body.email;
    const photoPath = req.file.path;

    // Send the photo to Telegram
    bot.sendPhoto(chatId, photoPath)
        .then(() => {
            // Send a confirmation response to the client
            res.send('Photo uploaded and sent to Telegram successfully!');
        })
        .catch((error) => {
            console.error(error);
            res.status(500).send('An error occurred while sending the photo to Telegram.');
        });
});

// Start the server
app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
