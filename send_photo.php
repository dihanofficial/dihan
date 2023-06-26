<?php
$botToken = 'YOUR_TELEGRAM_BOT_TOKEN';
$chatId = 'YOUR_TELEGRAM_CHAT_ID';

$photo = $_FILES['photo'];

// Send the photo to Telegram using the Bot API
$telegramUrl = 'https://api.telegram.org/bot' . $botToken . '/sendPhoto';
$postFields = array(
    'chat_id' => $chatId,
    'photo' => new CURLFile($photo['tmp_name'], $photo['type'], $photo['name'])
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $telegramUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

// Handle the result or perform any necessary actions

// Redirect the user back to the form page or show a success message
header('Location: index.html');
exit;
?>
