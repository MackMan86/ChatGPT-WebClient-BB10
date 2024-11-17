<?php
session_start();

// Prüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: index.php");
    exit();
}

// Sicherstellen, dass die Chat-ID gesetzt ist
if (!isset($_SESSION['chat_id']) || $_SESSION['chat_id'] === 'new') {
    $_SESSION['chat_id'] = uniqid(); // Neue Chat-ID generieren
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Chat with ChatGPT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            margin: 1px auto 0;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 75vh;
        }
        h1 {
            font-size: 14px;
            text-align: center;
            color: #333;
            margin-top: 2px;
            margin-bottom: 10px;
        }
        iframe {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        #chat-history {
            flex: 1.5;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            height: auto;
        }
        form {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        label {
            font-size: 10px;
            margin-right: 3px;
        }
        select {
            font-size: 10px;
            padding: 4px;
            width: 100px;
            margin-right: 3px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="text"] {
            padding: 8px;
            font-size: 16px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            flex: 1;
        }
        #sendButton {
            font-size: 16px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #sendButton:hover {
            background-color: #0056b3;
        }
        button {
            font-size: 10px;
            padding: 3px 6px;
            width: auto;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            margin-top: 10px;
            background-color: #dc3545;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Chat with ChatGPT</h1>

    <!-- Chat History -->
    <iframe src="chat_history.php" name="chatHistory" id="chat-history" frameborder="0"></iframe>

    <!-- Input Form -->
    <form id="messageForm" method="POST" target="chatHistory">
        <input type="text" name="user_message" id="userMessageInput" placeholder="Type your message here..." required>
        <button id="sendButton" type="submit">Send</button>
    </form>

    <!-- Select Chat -->
    <form action="delete_chat.php" method="POST" style="margin-top: 10px; display: flex; align-items: center;">
        <label for="chat_id">Choose a chat:</label>
        <select name="chat_id" id="chat_id" required>
            <option value="new">New Chat</option>
            <?php
            foreach (glob("chats/*.txt") as $filename) {
                $chatName = basename($filename, ".txt");
                echo "<option value=\"$chatName\">$chatName</option>";
            }
            ?>
        </select>
        <button type="submit" formaction="select_chat.php" style="margin-right: 5px;">Load Chat</button>
        <button type="submit" style="background-color: #dc3545; color: white;">Delete</button>
    </form>

    <!-- Logout -->
    <form action="logout.php" method="POST">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<script>
    document.getElementById("messageForm").addEventListener("submit", function(event) {
        event.preventDefault();

        var userMessage = document.getElementById("userMessageInput").value.trim();

        if (userMessage !== '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("userMessageInput").value = '';
                    var iframe = document.querySelector('iframe[name="chatHistory"]');
                    if (iframe) {
                        iframe.contentWindow.location.reload();
                    }
                }
            };
            xhr.send('user_message=' + encodeURIComponent(userMessage));
        }
    });

    // Auto-scroll für Chat-Verlauf
    document.getElementById("chat-history").onload = function () {
        const iframe = document.getElementById("chat-history");
        iframe.contentWindow.scrollTo(0, iframe.contentWindow.document.body.scrollHeight);
    };
</script>

</body>
</html>
