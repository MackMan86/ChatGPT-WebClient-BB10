<?php
session_start();

// Determine chat ID
$chatId = ($_POST['chat_id'] === 'new') ? uniqid() : $_POST['chat_id'];

// Save chat ID to session
$_SESSION['chat_id'] = $chatId;

// Redirect to chat.php
header("Location: chat.php");
exit();
?>
