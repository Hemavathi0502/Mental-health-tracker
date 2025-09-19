<?php
// Display errors for debugging (optional during development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userMessage = strtolower(trim($_POST['message'] ?? ''));

    // Simple rule-based AI replies
    if (strpos($userMessage, "happy") !== false) {
        echo "That's great to hear! 😊 Would you like a fun game or a hobby suggestion?";
    } elseif (strpos($userMessage, "sad") !== false) {
        echo "I'm here for you. Would you like a motivational quote or some relaxing music?";
    } elseif (strpos($userMessage, "angry") !== false) {
        echo "It’s okay to feel angry. Would a breathing exercise help?";
    } elseif (strpos($userMessage, "depressed") !== false) {
        echo "I'm really sorry you're feeling this way. You're not alone. Can I show you something uplifting?";
    } else {
        echo "Thanks for sharing. Tell me more, I'm listening.";
    }
} else {
    echo "No message received.";
}
?>