<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $user_email = $_SESSION['email'] ?? null;
    $message = trim($_POST['message']);

    if (!$user_email) {
        die("Error: User not logged in.");
    }
    if (empty($message)) {
        die("Error: Message cannot be empty.");
    }

    // Insert message into the database
    $stmt = $conn->prepare("INSERT INTO mood_tracker (email, message, timestamp) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $user_email, $message);

    if ($stmt->execute()) {
        echo "Message saved successfully.";
    } else {
        echo "Error saving message: " . $stmt->error;
    }
    $stmt->close();
}
?>
