<?php

function sendMessageToRasa($message) {
    $url = "http://localhost:5005/webhooks/rest/webhook";

    $data = json_encode([
        "sender" => "user",
        "message" => $message
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = $_POST["message"];
    $response = sendMessageToRasa($userMessage);

    if (!empty($response) && is_array($response)) {
        foreach ($response as $message) {
            if (isset($message['text'])) {
                // echo "<p>Bot: {$message['text']}</p>";
                // echo "{$message['text']}<br>"; 
                
                echo nl2br($message['text']); // tự động xuống dòng nếu có \n
                

            }

            // if (isset($message['image'])) {
            //     echo "<img src='{$message['image']}' alt='Product Image' style='width: 150px; height: auto;'>";
            // }
            if (isset($message['image'])) {
                echo "<div class='chat bot'>";
                echo "<img src='{$message['image']}' alt='Product Image' style='width: 140px; height: auto;'>";
                echo "</div>";
            }

        }
    } else {
        echo "<p>Không có phản hồi từ chatbot.</p>";
    }
}
?>

