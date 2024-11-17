<?php
session_start();

// Aktuelle Chat-ID abrufen
$chatId = $_SESSION['chat_id'] ?? 'new';
$chatLogFile = "chats/$chatId.txt";

// Chat-Historie anzeigen
if (file_exists($chatLogFile)) {
    $chatHistory = file_get_contents($chatLogFile);

    // Namen fett machen
    // "You:" wird in fett gesetzt
    $chatHistory = preg_replace('/^You:/m', '<strong>You:</strong>', $chatHistory);

    // "ChatGPT:" wird in fett gesetzt
    $chatHistory = preg_replace('/^ChatGPT:/m', '<strong>ChatGPT:</strong>', $chatHistory);

    echo nl2br($chatHistory); // Zeilenumbrüche erhalten
} else {
    echo "Chat started...";
}
?>
