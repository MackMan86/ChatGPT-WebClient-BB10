<?php
session_start();

// Sicherstellen, dass die Chat-ID vorhanden ist
if (!isset($_SESSION['chat_id'])) {
    $_SESSION['chat_id'] = uniqid(); // Generiert eine neue Chat-ID
}

$chatId = $_SESSION['chat_id'];
$chatLogFile = "chats/$chatId.txt";

// Nachricht des Benutzers verarbeiten
$userMessage = htmlspecialchars($_POST['user_message']);

// Nachricht in die Chat-Log-Datei schreiben
file_put_contents($chatLogFile, "You: $userMessage\n", FILE_APPEND);

// API-Aufruf und Antwort speichern
$apiKey = 'YOUR_API_KEY_HERE';
$apiUrl = 'https://api.openai.com/v1/chat/completions';

$data = [
    "model" => "gpt-3.5-turbo",
    "messages" => [["role" => "user", "content" => $userMessage]]
];

$options = [
    "http" => [
        "header" => "Content-Type: application/json\r\n" .
                    "Authorization: Bearer $apiKey\r\n",
        "method" => "POST",
        "content" => json_encode($data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($apiUrl, false, $context);

// Antwort von ChatGPT speichern
$responseData = json_decode($response, true);
$chatbotResponse = $responseData['choices'][0]['message']['content'] ?? 'Error: No response';

// Antwort in die Chat-Log-Datei schreiben
file_put_contents($chatLogFile, "ChatGPT: $chatbotResponse\n", FILE_APPEND);

// Chat-Historie neu laden
header("Location: chat_history.php");
exit();
?>
