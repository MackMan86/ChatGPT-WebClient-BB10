---

# ChatGPT Web Chat Script

This script allows you to use ChatGPT on older devices and browsers by hosting the chat on your own server. It is a lightweight and simple implementation with support for ChatGPT 3.5 and GPT-4. Enjoy using modern AI technology on devices that were previously unsupported!

---

## Installation Instructions

1. **Upload the Files:**
   - Copy all files to your own web hosting server.
   - Ensure your server supports **PHP** and **JavaScript**.
   - Create a subdirectory named `chats` in the same directory as the script files.
   - Set the `chats` folder permissions to **chmod 755**.

2. **Configure Your OpenAI API Key:**
   - Open `send_message.php`.
   - Enter your OpenAI **API key** in the appropriate line:
     ```php
     $apiKey = "YOUR_API_KEY_HERE";
     ```
   - Note: OpenAI services require you to set up a payment method for the API key to work.

3. **Choose Your ChatGPT Model:**
   - In `send_message.php`, locate the model selection line:
     ```php
     "model" => "gpt-4",
     ```
   - You can choose between `gpt-3.5-turbo` or `gpt-4`. 
   - Update the model **before entering your API key** to ensure the correct settings are applied.

4. **Set a Password for Login:**
   - Open `index.php`.
   - Locate the `define` line to set your own access password:
     ```php
     define("PASSWORD", "your_custom_password");
     ```
   - Replace `"your_custom_password"` with your desired password to secure access to the chat.

---

## Server Requirements

- A web hosting server with support for:
  - **PHP 7.4+**
  - **JavaScript**
- A subdirectory named `chats` with permissions set to **chmod 755**.

---

## Compatibility

- This script has been successfully tested on **BlackBerry 10 devices**.
- Compatibility with other older devices may vary and is currently unverified. Please report your findings if you test it on additional platforms.

---

## License

This script is free to use and does not fall under any specific license.

---

## Acknowledgments

Enjoy this script and the freedom it provides to use ChatGPT on older devices. If you encounter issues or have suggestions, feel free to share them!

**Best wishes,  
MackMan86**

---