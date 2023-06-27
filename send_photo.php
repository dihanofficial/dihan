

<?php

// Set your Telegram bot token and chat ID
$telegramBotToken = '5950338973:AAEMc2zBcEWKv5vPg7anK4DgIBvrWrM2nmM';
$telegramChatID = '1001927046640';

// Check if a file was uploaded successfully
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    // Get the temporary file location
    $photoTmpPath = $_FILES['photo']['tmp_name'];

    // Prepare the file name
    $photoName = $_FILES['photo']['name'];

    // Create a new file name to avoid any naming conflicts
    $newFileName = uniqid('', true) . '_' . $photoName;

    // Set the destination directory where the photo will be stored
    $destinationDir = 'photos/';

    // Move the uploaded file to the destination directory
    $moved = move_uploaded_file($photoTmpPath, $destinationDir . $newFileName);

    if ($moved) {
        // The file was successfully moved to the destination directory

        // Prepare the message to send to Telegram
        $message = 'New photo uploaded: ' . $newFileName;

        // Create the Telegram API URL
        $telegramAPIUrl = 'https://api.telegram.org/bot' . $telegramBotToken . '/sendMessage';

        // Send the message to Telegram
        $ch = curl_init($telegramAPIUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'chat_id' => $telegramChatID,
            'text' => $message,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            // An error occurred while sending the message to Telegram
            echo 'An error occurred while sending the photo to Telegram.';
        } else {
            // The message was successfully sent to Telegram
            echo 'Photo uploaded successfully and sent to Telegram.';
        }
    } else {
        // An error occurred while moving the uploaded file
        echo 'An error occurred while moving the uploaded file.';
    }
} else {
    // No file was uploaded or an error occurred during the upload
    echo 'No file uploaded or an error occurred during the upload.';
}
