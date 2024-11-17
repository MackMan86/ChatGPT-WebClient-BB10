<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chat_id'])) {
    $chatId = basename($_POST['chat_id']); // Schutz vor Pfadmanipulation
    $chatFile = "chats/$chatId.txt";

    // Prüfung: Verhindere das Löschen eines neuen Chats
    if ($chatId === "new") {
        echo "<script>alert('Cannot delete a new chat.'); window.location.href = 'chat.php';</script>";
        exit;
    }

    // Chat löschen, wenn er existiert
    if (file_exists($chatFile)) {
        if (unlink($chatFile)) {
            echo "<script>alert('Chat \"$chatId\" deleted successfully.'); window.location.href = 'chat.php';</script>";
        } else {
            echo "<script>alert('Failed to delete chat \"$chatId\".'); window.location.href = 'chat.php';</script>";
        }
    } else {
        echo "<script>alert('Chat \"$chatId\" does not exist.'); window.location.href = 'chat.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'chat.php';</script>";
}
